<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Page</title>
</head>

<body>
    <h1>Edit Page</h1>
    <div>
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $task->id }}">
            <input type="text" name="name" placeholder="task name" value="{{ $task->name }}">
            <input type="date" name="deadline" value="{{ $task->deadline }}">
            <button type="submit">Edit</button>
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
</body>

</html>
