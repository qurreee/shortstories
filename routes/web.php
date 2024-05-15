<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Middleware\Authenticate;
use App\Models\Genre;
use App\Models\Story;

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
    Route::get('/home', function () {
        $stories = Story::orderBy('created_at', 'desc')->get();
        return view('home', ['stories' => $stories]);
    })->name('home');

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
    Route::get('/story/{id}', [StoryController::class, 'view'])->name('story.view');;

    //like
    Route::post('/story/{id}/like', [StoryController::class, 'like']);

    //follow
    Route::post('/story/{id}/follow', [StoryController::class, 'follow']);
});

Route::get('coba', function () {
    return view('tailwind.login');
});
