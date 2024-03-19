<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Page</title>
</head>

<body>
    <h1>Create Page</h1>
    <div>
        <form method="POST" action="/tasks">
            @csrf
            <input type="text" name="name" placeholder="Add a task">
            <input type="date" name="deadline">
            <button type="submit">Add</button>
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
