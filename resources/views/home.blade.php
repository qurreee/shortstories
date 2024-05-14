<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    
        logged in
        <form action="/create-post" method="POST">
            @csrf
            <button>Upload new Story</button>
        </form>
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        <div style="background: gray; margin:10px">
            <h2>New Stories!</h2>
            @foreach($stories as $story)
            <a href="/story/{{$story['id']}}" style="text-decoration: none; color:black;">
                <div style="background-color: darkgray; padding:10px; margin:10px;">
                    <h3>{{$story['title']}}</h3>
                    <h3>Written by {{$story->writer->name}}</h3>
                    {{$story['body']}}
                </div>
            </a>
            @endforeach
        </div>

</body>
</html>