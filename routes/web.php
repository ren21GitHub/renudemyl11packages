<?php

use App\Helpers\ImageFilters;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

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

Route::get('image', function(){
    /* // create new image instance
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path('1.png'));
    // cut out a 200 x 150 pixel cutout at position 45,90
        $image->cover(200,150,45,90);
    // crop a 40 x 40 pixel cutout from the bottom-right and move it 30 pixel down
        // $image->crop(200, 150, 0 , 30, position: 'bottom-right');
    // apply blurring effect
        $image = $image->blur(8);
        $image->save('crop/cropBlur.png', 80); */

    /* // Shorter code
        $manager = new ImageManager(new Driver());
        $image = $manager->read(public_path('1.png'))
                ->crop(200, 150,45, 90)
                ->blur(8)
                ->save('crop/try.png', 80); */

    // Make a custom image filter    
        // create new image instance
            $manager = new ImageManager(new Driver());        
            $image = $manager->read(public_path('1.png'));
        // apply modifier
            $image->modify(new ImageFilters(25))
            ->save('crop/imageFilter3.png', 80);
        return Response::file(public_path('crop/imageFilter3.png'));
});