<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);


Route::resource('role', RoleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
