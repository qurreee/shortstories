<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <title>Home</title>
</head>
<body>
    <header>
        <x-navbar/>
    </header>
    <main class="mt-20">
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
                <div class=" bg-gray-400 mt-3 grid">
                    <h3 class="text-bold">{{$story['title']}}</h3>
                    <h3 class=" text-wrap flex">Written by {{$story->writer->name}}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </main>
        

</body>
</html>