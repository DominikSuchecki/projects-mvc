<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemsController;
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
    Route::get('projects/assign/{id}', [ProjectController::class, 'assignView'])->name('projects.assignView');
    Route::post('projects/assign/{id}', [ProjectController::class, 'assign'])->name('projects.assign');
    Route::delete('projects/{projectId}/users/{userId}', [ProjectController::class, 'unassign'])->name('projects.unassign');

    Route::get('projects/{id}/tasks', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('projects/{id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('projects/{id}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('projects/{projectId}/tasks/{taskId}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('projects/{projectId}/tasks/{taskId}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('projects/{projectId}/tasks/{taskId}', [TaskController::class, 'delete'])->name('tasks.delete');

    Route::get('projects/tasks/{taskId}/assign', [TaskController::class, 'assignView'])->name('tasks.assignView');
    Route::post('projects/tasks/{taskId}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::delete('projects/{projectId}/tasks/{taskId}', [TaskController::class, 'unassign'])->name('tasks.unassign');

    Route::middleware(Admin::Class)->group(function () {
        Route::resource('clients', ClientController::class);
        Route::resource('employees', EmployeesController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::resource('items', ItemsController::class);
    });

    /* TO DO...
        Route::get('comments', CommentController::class);
        Route::middleware(Manager::Class)->group(function () {

        });
    */
});

require __DIR__.'/auth.php';
