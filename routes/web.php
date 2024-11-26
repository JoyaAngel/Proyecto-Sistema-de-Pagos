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
    return view('welcome');
});
Route::get('/user', function () {
    return view('user');
});

Auth::routes();
/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);
Route::resource('client', ClientController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('project', ProjectController::class);
Route::resource('role', RoleController::class);

Route::post('/project/{project}/assign-supplier', [ProjectController::class, 'assignSupplier'])->name('project.assign.supplier');

Route::get('/index', function () {      //Cambiamos el nombre para q no choque con la de arriba
    return view('index');
})->middleware(AdminAuthenticate::class);
