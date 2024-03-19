<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Edit Page</title>
</head>

<body>
    <h1>Edit Page</h1>
    <div class="row">
        <form method="POST" action="/tasks/{{ $task->id }}" class="form-group">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $task->id }}" class="form-control">
            <input type="text" name="name" placeholder="task name" value="{{ $task->name }}"
                class="form-control">
            <input type="date" name="deadline" value="{{ $task->deadline }}" class="form-control">
            <button type="submit" class="btn btn-success">Edit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
</body>

</html>
