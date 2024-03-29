<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Admin;
use App\Http\Middleware\Manager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);
    Route::get('projects/assign/{id}', [ProjectController::class, 'assignView'])->name('assignView');
    Route::post('projects/assign/{id}', [ProjectController::class, 'assign']);

    Route::resource('tasks', TaskController::class);
    Route::resource('comments', CommentController::class);

    Route::middleware(Manager::Class)->group(function () {
    });

    Route::middleware(Admin::Class)->group(function () {
        Route::resource('clients', ClientController::class);
        Route::resource('employees', EmployeesController::class);
    });
});

require __DIR__.'/auth.php';
