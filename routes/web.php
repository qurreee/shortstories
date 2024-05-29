<?php


use App\Models\User;
use App\Models\Genre;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

//user
Route::post('/register', [UserController::class, 'register']);
Route::get('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/home', [StoryController::class, 'stories'])->name('home');

    Route::get('/create-post', function () {
        $genres = Genre::all();
        return view('newstory', ['genres' => $genres]);
    });

    //upload
    Route::post('/upload-story', [StoryController::class, 'upload']);
    //edit
    Route::get('/story/{id}/edit',[StoryController::class, 'gotoedit']);
    Route::post('/story/{id}/edit', [StoryController::class, 'edit']);
    //viewstory
    Route::get('/story/{id}', [StoryController::class, 'view'])->name('story.view');

    //like
    Route::post('/story/{id}/like', [StoryController::class, 'like']);

    //follow
    Route::post('/story/{id}/follow', [StoryController::class, 'follow']);
    
    Route::get('/coba', function(){
        $stories = Story::get();
        $genres = Genre::all();
        $userprofile = User::first();
        return view('backend.home', ['stories' => $stories, 'genres'=>$genres, 'userprofile' =>$userprofile]);
    });
    
    //profile this need tobe at the bottom
    Route::get('/profile/{username}', function($name){
        $userprofile = User::where('name', $name)->first();
        // Check if the user exists
        if ($userprofile) {
            // If the user exists, return the profile view with the user data
            return view('profile', ['userprofile' => $userprofile]);
        } else {
            // If the user does not exist, return an error or a custom 404 page
            abort(404);
        }
    });
    Route::post('/profile/{username}/follow', [UserController::class, 'follow']);
    Route::get('/profile/{username}/edit', [UserController::class, 'gotoEdit'] );
    
    Route::post('/profile/{username}/edit', [UserController::class, 'edit']);
    

    
    
    
});


// Route::get('/coba', function(){
//     $story = Story::first();
//     $genres = Genre::all();
//     $userprofile = User::first();
//     return view('tailwind.profile', ['story' => $story, 
//                                     'genres'=>$genres,
//                                     'userprofile' => $userprofile]);
// });
