<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::all();
        $employeeCount = Employee::count();
        $maleCount = Employee::where('gender', 'Male')->count();
        $femaleCount = Employee::where('gender', 'Female')->count();
        $averageAge = (int) Employee::select(DB::raw('AVG(TIMESTAMPDIFF(YEAR, birthday, CURDATE())) as average_age'))
        ->first()->average_age ?? 0;
        $totalSalary = number_format(Employee::sum('monthly_salary'), 2, '.', ',');

        return view('dashboard.index', compact('employees', 'employeeCount', 'maleCount', 'femaleCount', 'averageAge', 'totalSalary'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'monthly_salary' => 'required|numeric',
        ]);

        Employee::create($request->all());

        return redirect()->route('index')->with('success', 'Employee created successfully');
    }

    public function edit(Employee $employee)
    {
        return view('dashboard.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'monthly_salary' => 'required|numeric',
        ]);

        $employee->update($request->all());

        return redirect()->route('index')->with('success', 'Employee updated successfully')->withInput();
    }

    public function showDeleteForm(Employee $employee)
    {
        return view('dashboard.delete', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('index')->with('success', 'Employee deleted successfully');
    }

    public function datatables()
    {
        $employees = Employee::select(['id', 'first_name', 'last_name', 'gender', 'birthday', 'monthly_salary']);

        return DataTables::of($employees)
            ->addColumn('action', function ($employee) {
                $button = '<a class="btn btn-primary" href="' . route('edit', $employee->id) . '">Edit</a>';
                $button .= ' <a class="btn btn-danger" href="' . route('delete', $employee->id) . '">Delete</a>';
                return $button;
            })
            ->make(true);
    }
}
