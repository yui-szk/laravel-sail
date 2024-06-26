<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 関数とかクラスの機能説明
    public function index(Request $request)
    {
        $tasks = new Task;
        $filter = $request->filter;
        $sort = '';

        // コントローラーでDBの操作してるので以下はModelに書くべき
        // リクエストの値の正しさをチェックする

        switch ($request->sort) {
            case 'deadline':
                $sort = 'deadline|asc';
                break;
            case 'latest':
                $sort = 'created_at|desc';
                break;
            case 'oldest':
                $sort = 'created_at|asc';
        }

        // arr[]={[_->_], [_->_]}とかでmap?する
        // 別で関数にする
        // クエリビルダー

        // リクエストがあるかどうか->allかfilterとかか

        $tasks = Task::all();
        // 最初に
        // 条件文がエラーでも値が表示される

        if ($filter != null && $sort != null) {
            $tasks = Task::whereStatus($filter)->orderby(explode('|', $sort)[0], explode('|', $sort)[1])->get();
        } elseif ($filter != null) {
            $tasks = Task::whereStatus($filter)->get();
        } elseif ($sort != null) {
            $tasks = Task::orderby(explode('|', $sort)[0], explode('|', $sort)[1])->get();
        } 
        // else文は意味なく書かないように

        // isset, emptyとか　null以外

        $sort = $request->sort;

        return view('list', compact('tasks', 'filter', 'sort'));
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
        // ルートでidでfindしてくる
        // ModelBinding

        // status:状態を３つ以上
        // ２つならcompletedとか or
        // completed_dateでデータがあるかないか
        if ($request->status === null) {
        
            // trueにならないケース

            // バリデーションを別に書き出す->統一とか場所とか
            // クライアントとリクエストを受け取るところとDB前
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
