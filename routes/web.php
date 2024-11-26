<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});
Route::get('/user', function () {
    return view('user');
})->middleware('auth');

Auth::routes();
/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class)->middleware('auth');
Route::resource('client', ClientController::class)->middleware('auth');
Route::resource('supplier', SupplierController::class)->middleware('auth');
Route::resource('project', ProjectController::class)->middleware('auth');
Route::resource('role', RoleController::class);

Route::post('/project/{project}/assign-supplier', [ProjectController::class, 'assignSupplier'])->name('project.assign.supplier');

Route::get('/home', function () {      //Cambiamos el nombre para q no choque con la de arriba
    return view('home');
})->middleware(AdminAuthenticate::class)->name('home');
