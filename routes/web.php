<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('store');

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('update');

    Route::get('/employees/{employee}/delete', [EmployeeController::class, 'showDeleteForm'])->name('delete');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');

    Route::get('employees/datatables', [EmployeeController::class, 'datatables'])->name('datatables');
});
