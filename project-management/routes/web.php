<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::resource('projects', ProjectController::class);
Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
Route::put('projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('projects.tasks.update');
Route::delete('projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('projects.tasks.destroy');


Route::get('/', function () {
    return view('welcome');
});
