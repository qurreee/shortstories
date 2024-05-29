<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{$story['title']}}</title>
</head>
<body>
    <x-navbar/>
    
    <main class="mt-20">
        <h1>{{$story['title']}}</h1>
        
        @if ($story->cover && $story->cover !== 'null')
        <div class="p-10 rounded bg-blue-400 max-w-fit">
            <img src="{{asset('storage/photo/picfolder/'.$story->cover)}}" class=" object-cover w-48 h-96" alt="img">
        </div>
        @endif
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
    {{--  --}}
        <p>{{$story['body']}}</p>
        <form action="/story/{{$story->id}}/like" method="POST" >
            @csrf
            <button type="submit" id="like" name="like" value="1">Like</button>
            <button type="submit" id="dislike" name="like" value="2">Dislike</button>
        </form>

        <form action="/home">
            <button type="submit" class="block bg-blue-400">Go Home</button>
        </form>
    </main>
    
    {{-- <script type="module">
        $(document).ready(function () {
            $("#like").click(function() {
                let storyId = "{{ $story->id }}";
                $.ajax({
                    url: "/story/" + storyId + "/like",
                    type: "POST",
                    data: { like: 1, _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        alert('Liked!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            $(#dislike).click(function () {
                let storyId = "{{ $story->id }}";
                $.ajax({
                    url: "/story/" + storyId + "/like",
                    type: "POST",
                    data: { like: 1, _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        alert('Liked!');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>