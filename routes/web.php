<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdvanceController;
use App\Http\Middleware\CheckPasswordChange;
use App\Http\Middleware\UserAuthenticate;

//Route::get('/user', function () {
//    return view('user');
//})->middleware('auth');

Auth::routes();

Route::middleware([UserAuthenticate::class, CheckPasswordChange::class])->group(function(){

    Route::resource('organization', OrganizationController::class);
    Route::resource('client', ClientController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('advance', AdvanceController::class);

    Route::post('/project/{project}/assign-supplier', [ProjectController::class, 'assignSupplier'])->name('project.assign.supplier');

    Route::post('/user/{id}/password-reset', [UserController::class, 'passwordReset'])->name('user.passwordReset');
    Route::get('/home', function () {      //Cambiamos el nombre para q no choque con la de arriba
        return view('home');
    });

    Route::get('/', function () { return view('index');})->name('index');
});

Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password')->middleware('auth');
Route::post('/password-update', [UserController::class, 'updatePassword'])->name('password-update')->middleware('auth');

