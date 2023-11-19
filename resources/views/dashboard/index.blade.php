<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .dataTables_filter input {
            width: auto !important;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}">Employee Records</a>
                <div class="justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('create') }}">Add Employee</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container my-3">
            <h1 class="text-center">Summary</h1>
            <hr>
            <div class="container my-5">
                <div class="row">
                    <div class="col-3">
                        <canvas id="genderChart" width="100" height="100"></canvas>
                    </div>
                    <div class="col-9">
                        <div class="container mt-5 py-1">
                            <div class="card-deck row">
                                <div class="col-6">
                                    <div class="card mx-2">
                                        <div class="card-body row">
                                            <div class="col-4">
                                                <i class='bx bxs-calendar text-primary' style="font-size: 7rem"></i>
                                            </div>
                                            <div class="col-8 d-flex justify-content-center align-items-center">
                                                <div>
                                                    <h5 class="card-title">Average Age</h5>
                                                    <p class="card-text">{{ $averageAge }} years</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{ $employeeCount }} employees</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="card mx-2">
                                        <div class="card-body row">
                                            <div class="col-4">
                                                <i class='bx bx-money text-success' style="font-size: 7rem"></i>
                                            </div>
                                            <div class="col-8 d-flex justify-content-center align-items-center">
                                                <div>
                                                    <h5 class="card-title">Total Salary</h5>
                                                    <p class="card-text">${{ $totalSalary }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">{{ $employeeCount }} employees</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="text-center">Employee Records</h1>
            <hr>
            <table class="table" id="employees-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Monthly Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>

    <footer>
        <p class="text-center">&copy; Emerjoe Rosas 2023</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#employees-table').DataTable({
                responsive: true,
                serverSide: true,
                ajax: "{{ route('datatables') }}",
                columns: [{
                        name: 'id',
                        data: 'id'
                    },
                    {
                        name: 'first_name',
                        data: 'first_name'
                    },
                    {
                        name: 'last_name',
                        data: 'last_name'
                    },
                    {
                        name: 'gender',
                        data: 'gender'
                    },
                    {
                        name: 'birthday',
                        data: 'birthday'
                    },
                    {
                        name: 'monthly_salary',
                        data: 'monthly_salary'
                    },
                    {
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        data: 'action'
                    }
                ]
            });

            var genderData = {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $maleCount }}, {{ $femaleCount }}],
                    backgroundColor: ['#3498db', '#e74c3c'],
                }],
            };

            var genderChart = new Chart(document.getElementById('genderChart').getContext('2d'), {
                type: 'doughnut',
                data: genderData,
            });
        });
    </script>
</body>

</html>
