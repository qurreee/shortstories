<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Like;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function upload(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Story::create($incomingFields);
        return redirect('/home');
    }

    public function view($id)
    {
        $story = Story::with('writer')->find($id);

        if (!$story) {
            return redirect()->route('home')->with('error', 'Story not found');
        }

        return view('storyview', compact('story'));
    }

    public function like($id)
    {

        $story = Story::find($id);
        $like = request('like');
        $userid = auth()->user()->id;

        $exist = Like::where('user_id', $userid)
            ->where('story_id', $id)
            ->first();

        if ($exist) {
            if ($like == $exist->like) {
                Like::where('user_id', $userid)
                    ->where('story_id', $id)->delete();
            } else {
                Like::where('user_id', $userid)
                    ->where('story_id', $id)->update(array('like' => $like));
            }
        } else {
            $newlike = new Like();
            $newlike->user_id = $userid;
            $newlike->story_id = $id;
            $newlike->like = $like;
            $newlike->save();
        }
        return redirect()->back();
    }

    public function follow($id)
    {

        $story = Story::find($id);
        $writerid = $story->user_id;
        $userid = auth()->user()->id;


        $exist = Follower::where('follower_id', $userid)
            ->where('followed_id', $writerid)
            ->first();
        if ($exist) {
            Follower::where('follower_id', $userid)
                ->where('followed_id', $writerid)->delete();
        } else {
            $newfoll = new Follower();
            $newfoll->follower_id = $userid;
            $newfoll->followed_id = $writerid;
            $newfoll->save();
        }
        return redirect()->back();
    }
}
