<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use pp\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);


Route::resource('role', RoleController::class);

Route::resource('transaction', TransactionController::class);