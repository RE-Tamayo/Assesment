<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Employee</title>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="antialiased">
    <div class="container mt-5">
        <h1>Edit Employee</h1>
        <hr>

        <form method="POST" action="{{ route('update', $employee->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $employee->first_name }}">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $employee->last_name }}">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender">
                    <option value="Male" {{ $employee->gender === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $employee->gender === 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" name="birthday" id="birthday" value="{{ $employee->birthday }}">
            </div>

            <div class="mb-3">
                <label for="monthly_salary" class="form-label">Monthly Salary</label>
                <input type="number" class="form-control" name="monthly_salary" id="monthly_salary" value="{{ $employee->monthly_salary }}">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('index') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
