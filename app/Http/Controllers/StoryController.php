<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Genre;
use App\Models\Story;
use App\Models\Follower;
use App\Models\GenreTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
    public function upload(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        if($request->hasFile('cover')){
            $cover = $request->file('cover');
            $covername = time() . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/picfolder',$covername);
            $incomingFields['cover'] = $covername;
        }
        $story = Story::create($incomingFields);

        if ($request->has('genres')) {
            $selectedGenres = $request->input('genres');
            $story->genres()->attach($selectedGenres);
        }

        return redirect('/home');
    }

    public function view($id)
    {
        $story = Story::with('writer','genres')->find($id);

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

    public function gotoedit($id)
    {
        $story = Story::find($id);
        $genres = Genre::all();
        return view('edit', ['story' => $story, 'genres'=>$genres]);
    }

    public function edit($id, Request $request){
        $val = $request->input('edit');
        if($val == 1){
            $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required',
                'genres' => 'array'
            ]);
            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            
            $story = Story::find($id);
            $story->update(['title' => $incomingFields['title'], 'body' => $incomingFields['body']]);
    
            $genres = $incomingFields['genres'];
            $story->genres()->sync($genres);
            return redirect()->route('story.view',['id'=>$id]);
        }elseif($val == 2){
            $story = Story::find($id);
            $story->genres()->detach();
            $story->likes()->delete();
            $story->delete();
            return redirect()->route('home');
        }
    }

    public function stories(){
        $topstories = Story::select('stories.id', 'stories.title', 'stories.body', DB::raw('COUNT(likes.story_id) as like_count'))
    ->leftJoin('likes', 'stories.id', '=', 'likes.story_id')
    ->groupBy('stories.id', 'stories.title', 'stories.body')
    ->orderByDesc('like_count')
    ->limit(5)
    ->get();
        // genres
        $genres = Genre::withCount('stories')->orderBy('stories_count', 'desc')->limit(3)->get();

        $genre1 = $genres[0]->genre_name;
        $genres1 = $genres[0]->stories;

        // Genre 2
        $genre2 = $genres[1]->genre_name;
        $genres2 = $genres[1]->stories;

        // Genre 3
        $genre3 = $genres[2]->genre_name;
        $genres3 = $genres[2]->stories;



        $stories = Story::orderBy('created_at', 'desc')->get();
        // tinggal ganti ke tailwind.home
        return view('tailwind.home',
        ['stories' => $stories,
        'topstories' => $topstories,
        'genre1' => $genre1,
        'genre2' => $genre2,
        'genre3' => $genre3,
        'genres1' => $genres1,
        'genres2' => $genres2,
        'genres3' => $genres3,
    ]);
    }
}
