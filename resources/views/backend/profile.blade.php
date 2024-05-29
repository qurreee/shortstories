<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/css/app.css','resources/js/app.js' ])
    
    <title>Document</title>
</head>
<body>
    <x-navbar/>
    <main class="mt-20">
        <h1>{{ $userprofile->name }}</h1>
        <section>
            <form action="/profile/{$username}/follow" method="POST" id="follow">
                @csrf   
                @php
                $user = auth()->user();
            @endphp
                @if ($userprofile->id != $user->id)
                <button type="submit" id="followBtn">
                    @if ($user->isFollowing($userprofile->id))
                    Unfollow
                    @else
                    Follow
                    @endif
                </button>
                @endif
            </form>
        </section>
        <h1>email</h1>
        <p>{{$userprofile->email}}</p>
        <h1>profile</h1>
        <p>{{$userprofile->profile}}</p>
    
        <section>
            @php
                $stories = $userprofile->stories;
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container justify-items-strecth">
                    
                @foreach ($stories as $story)
                <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg hidden sm:block object-scale-down max-h-56 object-center w-full" src="{{URL('storage/photo/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-wrap">
                            <p>{!! \Illuminate\Support\Str::limit($story->body, 100) !!}...</p>
                        </div>
                        
                        <div class="mt-auto">
                            <a href="/story/{{$story['id']}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    
        
       
        @if(Auth::check() && $userprofile->id == Auth::user()->id)
        <button>Edit Profile</button>
        @endif
        
    </main>
    <h1>Profile</h1>
    {{-- foto profile --}}
    <h1>nama</h1>
    <p>{{$userprofile->name}}</p>
    

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () { 
            const followBtn = document.getElementById('followBtn');
            const followSts = document.getElementById('followSts');

            followBtn.addEventListener('click', function () { 
                const username = "{{ $userprofile->name }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('CSRF Token:', csrfToken);
                fetch('/profile/{{ $userprofile->name }}/follow', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        
                    },body: JSON.stringify({
                        username: {username:username} 
                    }),
                })
                .then(response => {
                    console.log(response)
                    console.log('Response:', response); 
                    if (response.status === 200) {
                        if (followBtn.innerText === 'Follow') {
                            followBtn.innerText = 'Unfollow';
                            followSts.innerText = 'Following';
                        } else {
                            followBtn.innerText = 'Follow';
                            followSts.innerText = 'Not Following';
                        }
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
             });
         });
    </script> --}}

    <script type="module">
        $(document).ready(function () {
            $(function () {
                $('#follow').on('submit', function (e) {
                    e.preventDefault();

                    let data = "{$username}";
                    let url = "/profile/{$username}/follow"
                    $.ajax({
                        type: "POST",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        url: url,
                        data: data,
                        success: function (response) {
                            $('#followBtn').innerText("HALLO");
                        }
                    });
                    
                });
             })
        });
    </script>
</body>
</html>