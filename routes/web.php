<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HourlyRates;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EmployeeController::class, 'index']);

Route::resource('/employee', EmployeeController::class);
Route::resource('/transaction', TransactionController::class);


Route::get('/transaction/create/{id}', [TransactionController::class, 'createTransaction'])->name('transaction.create.for.user');

Route::post('/transactionForUser', [EmployeeController::class, 'replaceStatusTransaction'])->name('employee.buy');

Route::post('/hourlyRates/create', [HourlyRates::class, 'saveForUser'])->name('hourly.rates.create.for.user');

Route::get('/payAll/{id}', [TransactionController::class, 'payAllTransaction'])->name('pay.all.transaction');
