<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::apiResources([

    'employees'  => EmployeeController::class,
    'suppliers'  => SupplierController::class,
    'categories' => CategoryController::class,
    'products'   => ProductController::class,
    'expenses'   => ExpenseController::class,
    'customers'  => CustomerController::class,
]);
//salary 
Route::post('/salary/paid/{id}', [SalaryController::class, 'paySalary']);
Route::get('/salaries', [SalaryController::class, 'allSalaries']);
Route::get('/salary-details/{id}', [SalaryController::class, 'salaryDetails']);
Route::get('/salaries/{id}', [SalaryController::class, 'salaryEdit']);
Route::post('/salaries/{id}', [SalaryController::class, 'salaryUpdate']);

//Stock update
Route::post('/stock/update/{id}', [ProductController::class, 'stockUpdate']);

//Category wise product getting
Route::get('/category-wise/products/{id}', [PosController::class, 'categoryWiseProducts']);
