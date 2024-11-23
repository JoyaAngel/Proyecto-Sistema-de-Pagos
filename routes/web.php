<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/index', function () {
    return view('index');
});
/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);
Route::resource('role', RoleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {      //Cambiamos el nombre para q no choque con la de arriba
    return view('dashboard.home');
})->middleware(AdminAuthenticate::class);
