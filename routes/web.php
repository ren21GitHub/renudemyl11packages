<?php

use App\Helpers\ImageFilters;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    // SHOPPING CART
        Route::get('shop', [CartController::class, 'shop'])->name('shop');
        Route::get('cart', [CartController::class, 'cart'])->name('cart');
        Route::get('add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('add-to-cart');
        Route::get('qty-increment/{rowId}', [CartController::class, 'qtyIncrement'])->name('qty-increment');
        Route::get('qty-decrement/{rowId}', [CartController::class, 'qtyDecrement'])->name('qty-decrement');
        Route::get('remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('remove-product');

    // LARAVEL-PERMISSION
        Route::get('create-role', function(){
        // CREATING A ROLE    
            /* $role = Role::create(['name' => 'publisher']);
            return $role; */
        
        // CREATING A PERMISSION
            /* $permission = Permission::create(['name' => 'edit articles']);
            return $permission; */

            $user = auth()->user();
        // Adding permissions via a role
            // $user->assignRole('writer');
            // $user->getRoleNames();

            // $user->givePermissionTo('edit articles');
            // $user->getPermissionNames();

        // returns 1 if user can edit articles and returns null if false
            // $checkPermission = $user->can('edit articles');
            // return $checkPermission;

        // sample on how you can use can() method
            if($user->can('edit articles')){
                return 'User have permission to edit Articles';
            }else {
                return 'User do not have permission';
            }
        });
    
    // How to check role and permission at the blade
        Route::get('posts', function(){
            // $user = auth()->user();
            // $user->assignRole('editor');

            $posts = Post::all();
            return view('post.post', compact('posts'));
        });
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

