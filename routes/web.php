<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Models\Story;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/home', function () {
    $stories = Story::all();
    return view('home', ['stories' => $stories]);
});

Route::post('/create-post', function () {
    return view('/newpost');
});
//user
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//upload
Route::post('upload-post', [StoryController::class, 'upload']);

//viewstory
Route::get('/story/{id}', [StoryController::class, 'view']);
Route::post('/story/{id}/like', [StoryController::class, 'like']);

//follow
Route::post('/story/{id}/follow', [StoryController::class, 'follow']);

Route::get('/coba', function () {
    return view('coba');
});
