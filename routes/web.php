<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     $users = User::paginate(10);
//     return view('dashboard', compact('users'));
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [UserController::class, 'dataTableLogic'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('user/{id}/edit', function($id){
    return $id;
})->name('user.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // // EXPORT BUTTONS
    //     Route::get('export-excel', [UserController::class, 'exportExcel'])
    //         ->name('users.excel');
    //     Route::get('export-csv', [UserController::class, 'exportCsv'])
    //         ->name('users.csv');
    //     Route::get('export-pdf', [UserController::class, 'exportPdf'])
    //         ->name('users.pdf');
});

require __DIR__.'/auth.php';

// Route::get('/datatables', [UserController::class, 'dataTableLogic']);


