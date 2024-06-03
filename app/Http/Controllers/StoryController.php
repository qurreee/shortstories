<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Genre;
use App\Models\Story;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $incomingFields['body'] = clean($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        if($request->hasFile('cover')){
            $cover = $request->file('cover');
            $covername = time() . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/photo/picfolder',$covername);
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
        $likecount = $story->likeCount();

        if (!$story) {
            return redirect()->route('home')->with('error', 'Story not found');
        }

        return view('storyview', ['story' =>$story, 'likecount' => $likecount]);
    }

    public function like($id)
    {
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
        return view('editstory', ['story' => $story, 'genres'=>$genres]);
    }

    public function edit($id, Request $request)
    {
        $val = $request->input('edit');
        if($val == 1){
            $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required',
                'genres' => 'array',
                'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            
            $story = Story::find($id);

            if($request->hasFile('cover')){

                $oldCover = $story->cover;
                if($oldCover) {
                    Storage::delete('public/photo/picfolder/' . $oldCover);
                }
                
                $cover = $request->file('cover');
                $covername = time() . '_' . $cover->getClientOriginalName();
                $cover->storeAs('public/photo/picfolder',$covername);
                $incomingFields['cover'] = $covername;
                $story->update(['title' => $incomingFields['title'], 'body' => $incomingFields['body'], 'cover' => $incomingFields['cover']]);
            }else{
                $story->update(['title' => $incomingFields['title'], 'body' => $incomingFields['body']]);
            }

            
    
            $genres = $incomingFields['genres'];
            $story->genres()->sync($genres);
            return redirect()->route('story.view',['id'=>$id]);
        }elseif($val == 2){
            $story = Story::find($id);
            $story->genres()->detach();
            $oldCover = $story->cover;
            if($oldCover){
                Storage::delete('public/picfolder/' . $oldCover);
            }
            $story->likes()->delete();
            $story->delete();
            return redirect()->route('home');
        }
    }

    public function stories()
    {
        $topstories = Story::select('stories.id', 'stories.title', 'stories.body', 'stories.cover', DB::raw('COUNT(likes.story_id) as like_count'))
            ->leftJoin('likes', 'stories.id', '=', 'likes.story_id')
            ->groupBy('stories.id', 'stories.title', 'stories.body', 'stories.cover')
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
        return view('home',
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

    public function genreview($genrename){
        $genre = Genre::where('genre_name', $genrename)->first();
        $stories = $genre->stories;
        return view('genreview', ['stories' => $stories,
    'genrename' =>$genrename]);
    }
    
    public function search(Request $request){
        $query = $request->input('search');
        $stories = Story::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(body) LIKE ?', ['%' . strtolower($query) . '%'])
                ->get();
        return view('search', ['stories' => $stories, 'query'=>$query]);
        
    }
}
