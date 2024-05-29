<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js' ])
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <title>ShortStories</title>
</head>
<body class="bg-white dark:bg-gray-900">
    <x-navbar/>
    

        <main class="mt-20 min-h-screen max-w-full bg-white dark:bg-gray-900 justify-center content-center">
            <div class="container mx-auto mb-10">
                <h1 class=" text-center mt-10 mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Profile</h1>
            </div>
            
                   
                    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0" >
                        <div class="my-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                            <div class=" w-full sm:max-w-md mx-auto mb-8">
                                
                                <div class=" flex-none mx-auto lg:max-w-2xl xl:max-w-4x">
                                    <div class="p-10 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                        <div class="flex items-center gap-8 mb-10">
                                            @if ( $userprofile->pic != null && $userprofile->pic)
                                            <img class="rounded-full w-36 h-36 ring-8 ring-gray-300 dark:ring-gray-500" src="{{asset('storage/photo/profilepic/'). $userprofile->pic}}" alt="Bordered avatar">
                                            @else
                                            <img class="rounded-full w-20 h-20 ring-2 ring-gray-300 dark:ring-gray-500" src="{{ URL('storage/photo/webresource/pp.jpeg') }}" alt="Bordered avatar">
                                            @endif
                                            
                                            <div class=" text-3xl font-extrabold text-gray-900 dark:text-gray-300">
                                                <div> {{ $userprofile->name }}</div>
                                                <div class="text-lg font-bold text-gray-700 dark:text-gray-400 ">{{ $userprofile->email }}</div>
                                            </div>

                                            <div class="ml-auto">
                                                @if ($userprofile == auth()->user())
                                                <form action="/profile/{{ $userprofile->name }}/edit" method="GET">
                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit Profile</button>
                                                </form>
                                                @else
                                                <form action="/profile/{{ $userprofile->name }}/follow" method="POST">
                                                    @csrf
                                                    @php
                                                        $user = auth()->user();
                                                    @endphp
                                                    @if ($user->isFollowing($userprofile->id))
                                                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Unfollow</button>
                                                    @else
                                                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Follow</button>
                                                    @endif
                                                </form>
                                                
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-xl font-bold text-gray-900 dark:text-gray-300">About Me</p>
                                            <div class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-wrap">
                                                @if ($userprofile->profile && $userprofile->profile != null)
                                                <p>{{ $userprofile->profile }}</p>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="w-full">
                                    <div class="p-10 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                        <div>
                                            <div class="font-extrabold text-2xl text-gray-900 dark:text-gray-300 mx-auto max-w-fit mb-5">
                                                <p>{{ $userprofile->name }}'s Stories</p>
                                            </div>
                                        </div>
                                        
                                        <section>
                                            @php
                                                $stories = $userprofile->stories;
                                            @endphp
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mx-auto container justify-items-strecth">
                                                    
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="flex my-10">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-1/2 mx-auto">Upload</button>
                        </div> --}}
                    </div>
            

        </main>

    



    <x-upbutton/>
    <x-footer/>
    @stack('scripts')
</body>
</html>