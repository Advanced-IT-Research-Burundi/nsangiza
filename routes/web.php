<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::resource("file",FileController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard/recent', [App\Http\Controllers\DashboardController::class, 'recentFiles'])->name('dashboard.recent');
    Route::get('/dashboard/shared', [App\Http\Controllers\DashboardController::class, 'sharedFiles'])->name('dashboard.shared');
    Route::get('/dashboard/all', [App\Http\Controllers\DashboardController::class, 'allFiles'])->name('dashboard.all');
    Route::post('/dashboard/upload', [App\Http\Controllers\DashboardController::class, 'upload'])->name('dashboard.upload');
    Route::get('/dashboard/download/{id}', [App\Http\Controllers\DashboardController::class, 'download'])->name('dashboard.download');
    Route::post('/dashboard/share/{id}', [App\Http\Controllers\DashboardController::class, 'shareFile'])->name('dashboard.share');
    Route::get('/dashboard/file/{id}/details', [App\Http\Controllers\DashboardController::class, 'fileDetails'])
         ->name('dashboard.file.details');
    Route::resource('files', App\Http\Controllers\FileController::class);
    Route::resource('shared-files', App\Http\Controllers\SharedFileController::class);
    Route::resource('file-activities', App\Http\Controllers\FileActivityController::class);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';





