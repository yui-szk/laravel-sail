<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = new Task;
        $filter = $request->filter;
        $sort = '';

        switch ($request->sort) {
            case 'deadline':
                $sort = 'deadline|asc';
                break;
            case 'latest':
                $sort = 'created_at|desc';
                break;
            case 'oldest':
                $sort = 'created_at|asc';
                break;
        }

        if ($filter != null && $sort != null) {
            $tasks = Task::whereStatus($filter)->orderby(explode('|', $sort)[0], explode('|', $sort)[1])->get();
        } elseif ($filter != null) {
            $tasks = Task::whereStatus($filter)->get();
        } elseif ($sort != null) {
            $tasks = Task::orderby(explode('|', $sort)[0], explode('|', $sort)[1])->get();
        } else {
            $tasks = Task::all();
        }

        $sort = $request->sort;

        return view('list', compact('tasks', 'filter', 'sort'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:50',
            'deadline' => 'nullable',
        ]);

        $task = new Task();

        $task->name = $request->name;
        $task->deadline = $request->deadline;
        $task->status = $request->boolean(0);

        $task->save();

        return redirect('/tasks');
    }

    public function edit($id)
    {
        $task = Task::find($id);

        return view('edit', compact('task'));
    }

    public function update(Request $request)
    {
        $task = Task::find($request->id);

        if ($request->status === null) {
            $request->validate([
                'name' => 'required|max:50',
                'deadline' => 'nullable',
            ]);

            $task->name = $request->name;
            $task->deadline = $request->deadline;

        } else {
            $task->status = true;
        }

        $task->save();

        return redirect('/tasks');
    }

    public function destroy(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete($request->id);

        return redirect('/tasks');
    }
}
