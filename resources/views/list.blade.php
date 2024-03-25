<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>List Page</title>
</head>

<body class="m-4">
    <h1>Todo List</h1>
    <div class="my-2">
        <div>
            <form method="POST" action="/tasks" class="w-25">
                @csrf
                <input type="text" name="name" placeholder="Add a task" class="form-control">
                <input type="date" name="deadline" class="form-control">
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </form>
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form action="/tasks" method="GET" class="d-flex align-items-center my-3">
        <label for="task-select" class="mx-2">Sort:</label>
        <select name="sort" id="task-sort" onchange="submit(this.form)" class="form-select w-25 me-3">
            <option value="">default</option>
            <option value="deadline" {{ isset($sort) && $sort === 'deadline' ? 'selected' : '' }}>deadline</option>
            <option value="latest" {{ isset($sort) && $sort === 'latest' ? 'selected' : '' }}>latest</option>
            <option value="oldest" {{ isset($sort) && $sort == 'oldest' ? 'selected' : '' }}>oldest</option>
        </select>
        <label for="task-filter" class="mx-2">Filter:</label>
        <select name="filter" id="task-filter" onchange="submit(this.form)" class="form-select w-25">
            <option value="">default</option>
            <option value="1" {{ isset($filter) && $filter === '1' ? 'selected' : '' }}>completed</option>
            <option value="0" {{ isset($filter) && $filter === '0' ? 'selected' : '' }}>not-completed</option>
        </select>
    </form>
    <table class="table table-borderless table-sm">
        <tr class="table-light">
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
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <input type="hidden" name="status" value="{{ $task->status }}">
                        <input type="checkbox" name="status" {{ $task->status ? 'checked' : '' }}
                            class="form-check-input" disabled />
                        <button type="submit" class="btn btn-primary btn-sm">complete</button>
                    </form>
                </td>
                <td>
                    <a href="/tasks/{{ $task->id }}/edit" method="GET">
                        <button type="submit" class="btn btn-success btn-sm">edit</button>
                    </a>
                </td>
                <td>
                    <form onsubmit="return deleteTask();" action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

<script>
    function deleteTask() {
        return confirm('本当に削除しますか？') ? true : false;
    }
</script>

</html>
