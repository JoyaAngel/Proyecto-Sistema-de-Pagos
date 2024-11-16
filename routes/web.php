<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.organizations.clients.create');
});

/*
Rutas para el recurso Organization
*/
Route::resource('organization', OrganizationController::class);


Route::resource('role', RoleController::class);