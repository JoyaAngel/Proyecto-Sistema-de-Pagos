<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('index');
})->name('dashboard');
/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);
Route::resource('client', ClientController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('project', ProjectController::class);


Route::resource('role', RoleController::class);


Route::get('/projects/{project}/assign-supplier', [ProjectController::class, 'assignSupplier'])->name('project.assign.supplier');
