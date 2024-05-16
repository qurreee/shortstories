<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <h2>Edit POST</h2>
        <form action="/story/{{$story->id}}/edit" method="POST">
            @csrf
            <input type="text" name="title" value="{{$story->title}}">
            <textarea name="body">{{$story->body}}</textarea>
            <div style="background-color: aquamarine; margin:5px; color:black">
                @foreach ($genres as $genre)
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ $story->genres->contains('id', $genre->id) ? 'checked' : '' }}> {{ $genre->genre_name }}<br>
                @endforeach
            </div>
            <button name="edit" value="1">Edit</button>
            <button name="edit" value="2">Delete</button>
        </form>
    </div>
</body>
</html>
