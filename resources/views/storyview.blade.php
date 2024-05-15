<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <title{{$story['title']}}</title>
</head>
<body>
    <h1>{{$story['title']}}</h1>
    written by {{$story->writer->name}}

    <form action="/story/{{$story->id}}/follow" method="POST">
        @csrf
        @php
            $user = auth()->user();
        @endphp
        @if ($story->user_id !== $user->id)
            @if ($user->isFollowing($story->user_id))
                <button type="submit" name="follow">Unfollow</button>
            @else
                <button type="submit" name="follow">Follow</button>
            @endif
        @endif
    </form>

    <div>
        <p>Genre :</p>
        <div class="flex gap-10 justify-left">
            @foreach ($story->genres as $genre)
            <a href="#" >
                <div class=" p-2 bg-blue-300 rounded">
                    {{$genre->genre_name}}
                </div>
            </a>
            @endforeach
        </div>
    </div>

    @php
        $user = auth()->user();
     @endphp
     @if ($story->user_id == $user->id)
     <form action="/story/{{$story['id']}}/edit">
         @csrf
         <button type="submit" name="edit">edit</button>
     </form>
    @endif

    <p>{{$story['body']}}</p>
    <form action="/story/{{$story->id}}/like" method="POST">
        @csrf
        <button type="submit" name="like" value="1">Like</button>
        <button type="submit" name="like" value="2">Dislike</button>
    </form>
    <form action="/home">
        <button type="submit" class="block bg-blue-400">Go Home</button>
    </form>


    {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
</body>
</html>