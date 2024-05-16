<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Models\Genre;

Route::get('/', function () {
    return view('tailwind.login');
});

Route::get('/register', function () {
    return view('tailwind.register');
});

//user
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/home', [StoryController::class, 'stories'])->name('home');

    Route::post('/create-post', function () {
        $genres = Genre::all();
        return view('/newpost', ['genres' => $genres]);
    });

    //upload
    Route::post('/upload-post', [StoryController::class, 'upload']);
    //edit
    Route::get('/story/{id}/edit',[StoryController::class, 'gotoedit']);
    Route::post('/story/{id}/edit', [StoryController::class, 'edit']);
    //viewstory
    Route::get('/story/{id}', [StoryController::class, 'view']);

    //like
    Route::post('/story/{id}/like', [StoryController::class, 'like']);

    //follow
    Route::post('/story/{id}/follow', [StoryController::class, 'follow']);
});


Route::get('/coba', [StoryController::class, 'stories']);
