<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Page</title>
</head>

<body>

    <h1>List Page</h1>
    <div>
        <a href="/tasks/create" method="GET">
            <button type="submit">Add a task</button>
        </a>
        <form action="/tasks" method="GET">
            <label for="task-select">Sort:</label>
            <select name="sort" id="task-sort" onchange="submit(this.form)">
                <option value="">default</option>
                <option value="deadline" {{isset($sort) && $sort === 'deadline' ? 'selected' : ''}}>deadline</option>
                <option value="latest" {{ isset($sort) && $sort === 'latest' ? 'selected' : ''}}>latest</option>
                <option value="oldest" {{ isset($sort) && $sort == 'oldest' ? 'selected' : ''}}>oldest</option>
            </select>
            <label for="task-filter">Filter:</label>
            <select name="filter" id="task-filter" onchange="submit(this.form)">
                <option value="">default</option>
                <option value="1" {{ isset($filter) && $filter === '1' ? 'selected' : ''}}>completed</option>
                <option value="0" {{ isset($filter) && $filter === '0' ? 'selected' : ''}}>not-completed</option>
            </select>
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>
                    name
                </th>

                <th>
                    deadline
                </th>
                <th>
                    created_at
                </th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        {{ $task->name }}
                    </td>
                    <td>
                        {{ $task->deadline }}
                    </td>
                    <td>
                        {{ $task->created_at }}
                    </td>
                    <td>
                        <form action="/tasks/{{$task->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <input type="hidden" name="status" value="{{$task->status}}">
                            <input type="checkbox" name="status" {{ $task->status ? 'checked' : '' }} />
                            <button type="submit">complete</button>
                        </form>
                    </td>
                    <td>
                        <a href="/tasks/{{ $task->id }}/edit" method="GET">
                            <button type="submit">edit</button>
                        </a>
                    </td>
                    <td>
                        <form onsubmit="return deleteTask();" action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <button type="submit">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

<script>
    function deleteTask() {
        return confirm('本当に削除しますか？') ? true : false;
    }
</script>

</html>
