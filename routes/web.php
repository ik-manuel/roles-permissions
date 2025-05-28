<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::get('/users', [UserPermissionController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserPermissionController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}/update', [UserPermissionController::class, 'update'])->name('users.update');
});

Route::get('/assign/roles', [AssignmentController::class, 'assignRolesPermissions'])->name('assign.roles');
Route::get('/assign/users', [AssignmentController::class, 'assignUsersRolesPermissions'])->name('assign.users');

Route::post('/assign/roles/{role}/permission-toggle', [AssignmentController::class, 'toggleRolePermission']);
Route::post('/assign/users/{user}/role-toggle', [AssignmentController::class, 'toggleUserRole']);
Route::post('/assign/users/{user}/permission-toggle', [AssignmentController::class, 'toggleUserPermission']);