<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="antialiased">
    <div class="container mt-5">
        <h1>Delete Employee</h1>
        <hr>
        <p>Are you sure you want to delete this employee?</p>
        <form method="POST" action="{{ route('destroy', $employee->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
