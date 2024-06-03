<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:12', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'name')],
            'password' => ['required', 'min:8', 'max:20']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/home');
    }
    public function follow($username)
    {
        $userid = auth()->user()->id;
        $profile = User::where('name', $username)->first();
        $profileid = $profile->id;

        $exist = Follower::where('follower_id', $userid)
        ->where('followed_id', $profileid)
        ->first();
        if ($exist) {
            Follower::where('follower_id', $userid)
                ->where('followed_id', $profileid)->delete();
        } else {
            $newfoll = new Follower();
            $newfoll->follower_id = $userid;
            $newfoll->followed_id = $profileid;
            $newfoll->save();
        }
        return redirect()->back();

        // $username = $request['username'];
        // $userprofile = User::where('name', $username)->firstOrFail();
        // $userid = auth()->user()->id;
        // $user = User::where('id',$userid);
        // $status = $user->isFollowing($userprofile->id);

        // $exist = Follower::where('follower_id', $userid)
        //     ->where('followed_id', $userprofile->id)
        //     ->first();
            
        // if ($exist) {
        //     Follower::where('follower_id', $userid)
        //         ->where('followed_id', $userprofile->id)->delete();
        // } else {
        //     $newfoll = new Follower();
        //     $newfoll->follower_id = $userid;
        //     $newfoll->followed_id = $userprofile->id;
        //     $newfoll->save();
        // }
        // return response()->json([
        //     'status' => 200,
        //     'isFollowing' => !$status
        // ]);
    }

        public function gotoEdit(){
            $userid = Auth::user()->id;
            $userprofile = User::find($userid);
            return view('editprofile',['userprofile' => $userprofile]);
        }
        
        public function edit(Request $request){
            
            $incomingFields= $request->validate([
                'editname' => ['required', 'min:3', 'max:12', Rule::unique('users', 'name')],
                'editprofile' => ['nullable', 'max:255','string'],
                'editpic' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $incomingFields['editprofile'] = strip_tags($incomingFields['editprofile']);
            $incomingFields['editname'] = strip_tags($incomingFields['editname']);

            $userid = Auth::user()->id;
            $user = User::find($userid);

            if($request->hasFile('editpic')){
                    if($user->pic) {
                        Storage::delete('public/photo/profile_pics/' . $user->pic);
                    }
                $pic = $request->file('editpic');
                $picName = time() . '_' . $pic->getClientOriginalName();
                $pic->storeAs('public/photo/profile_pics', $picName);
                $incomingFields['pic'] = $picName;
                $user->update(['name' => $incomingFields['editname'], 'profile' => $incomingFields['editprofile'], 'pic' =>$incomingFields['editpic']]);
            }else{
                $user->update(['name' => $incomingFields['editname'], 'profile' => $incomingFields['editprofile']]);
            }
            return redirect('/profile/' . urlencode($user->name))->with('success', 'Profile updated successfully');
            
        }
        public function likeView(){
            $userid = Auth::user()->id;

            $likedStories = Like::where('user_id', $userid)->pluck('story_id');
            $stories = Story::whereIn('id', $likedStories)->get();

            return view('likeview', ['stories' =>$stories]);
        }
}
