<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/develop',function(){
    return 'Welcome to the Himalaya';
})->name('develop.index');

Route::get('/develop/{develops}',function($develops){
    if ( $develops === '5' ){
        return redirect()->route('develop.index');
    }
    return 'Detalles del Desarrollador ' . $develops;
});

Route::view('/welcome2','welcome')->name('welcome');

/*
Route::get('/dashboard', function () {
    //Ejecuciòn del middleware, antes de devolver o mostrar una vista
    return view('dashboard');
    //Tambièn se puede ejecutar despues de devolverlo mostrar una vista
})->middleware(['auth'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Ruta personalizada para llamar la función de index y mostrar los posteos
Route::get('/posts',[PostController::class, 'index'])-> name('post.index');

//Ruta personalizada para crear el registro en la BD de Posts
Route::post('/posts',[PostController::class, 'store'])->name('post.store');

//Route::get('/posts', function(){
  //  return view('posts');
//})->name('posts.index');


/*Route::post('/posts', function() {
    //return 'Posting Now...';
    //return request('message');
    $message = request('message');
    Post::create([
        'message' => $message,
        'user_id' => auth()->id()
    ]);

    return to_route('posts.index');
});*/

require __DIR__.'/auth.php';
