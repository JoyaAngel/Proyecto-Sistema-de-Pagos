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
use App\Models\Advance;

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

    Route::post('/project/assign-supplier', [ProjectController::class, 'assignSupplier'])->name('project.assign.supplier');
    Route::get('/payments/{supplier}', [PaymentController::class, 'show'])->name('payments.show');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/all', [PaymentController::class, 'index'])->name('payments.index_all');

    Route::post('/user/{id}/password-reset', [UserController::class, 'passwordReset'])->name('user.passwordReset');
    Route::get('/home', function () {return view('home');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/all', [PaymentController::class, 'index'])->name('payments.index_all');
    Route::get('/advances', [AdvanceController::class, 'index'])->name('advances.index');
    Route::get('/totaladvances', [AdvanceController::class, 'total'])->name('advances.total');
    Route::get('/payments/deudas', [PaymentController::class, 'deudas'])->name('payments.deudas');
    Route::get('/cobros', [AdvanceController::class, 'index'])->name('advances.cobros');

    Route::get('/project/{project}/advances', [AdvanceController::class, 'showAdvances'])->name('project.advances.show');
    });

    Route::get('/', function () { return view('index');})->name('index');
});

Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password')->middleware('auth');
Route::post('/password-update', [UserController::class, 'updatePassword'])->name('password-update')->middleware('auth');

