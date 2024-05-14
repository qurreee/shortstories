<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    @php
        $user = auth()->user();
     @endphp
     @if ($story->user_id == $user->id)
     <form action="/story/{{$story['id']}}/edit" method="GET">
         @csrf
         <button type="submit" name="edit" value="1">edit</button>
         <button type="submit" name="edit" value="2">delete</button>
     </form>
    @endif

    <p>{{$story['body']}}</p>
    <form action="/story/{{$story->id}}/like" method="POST">
        @csrf
        <button type="submit" name="like" value="1">Like</button>
        <button type="submit" name="like" value="2">Dislike</button>
    </form>
    <form action="/home">
        <button type="submit">Go Home</button>
    </form>
    
</body>
</html>