<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EmployeesController;
use \App\Http\Controllers\CompaniesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group( function () {

        Route::resource('company', CompaniesController::class);
        Route::resource('employee', EmployeesController::class);

        // DataTable
        Route::get('/simple-companies', [CompaniesController::class, 'simpleCompanies'])->name('company.simple-companies');
        Route::get('/serverside-companies', [CompaniesController::class, 'serversideCompanies'])->name('company.serverside-companies');


        Route::get('/get-companies', [CompaniesController::class, 'getAllCompanies'])->name('get-all-companies');
    });

require __DIR__.'/auth.php';
