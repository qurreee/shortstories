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
            <h1 class=" text-center mt-10 mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">{{ $story->title }}</h1>
        </div>
        <form enctype="multipart/form-data" action="/upload-story" method="POST">
                @csrf
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0" >
                    @if ($story->cover && $story->cover !== 'null')
                    <div class="my-6 sm:mt-8 justify-center md:gap-6 lg:flex lg:items-start xl:gap-8">
                        <div class=" w-full ">
                           
                            <div class="max-w-sm  justify-end mx-auto">
                                <div>
                                   
                                    <img class="rounded-lg hidden sm:block max-h-lvh object-cover w-full" src="{{asset('storage/photo/picfolder/'.$story->cover)}}" alt="" />
                                    
                                </div>
                            </div>
                            
                        </div>
                        @endif
                        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mb-5">
                            <div class=" p-5 border border-gray-300 rounded-lg bg-white justify-normal dark:bg-gray-800 dark:border-gray-600 ">
                                <div>
                                    <label for="writer" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Writer</label>
                                    <a href="/profile/{{ $story->writer->name }}">
                                        <p id="writer"  class="block mb-2 text-4xl font-extrabold text-gray-900 dark:text-white">{{ $story->writer->name }}</p>
                                    </a>
                                    
                                </div>
                                <div>
                                    <label for="genre" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Genres</label>
                                    <div class="flex gap-5 justify-left mb-2">
                                        @foreach ($story->genres as $genre)
                                        <a href="" >
                                            <div class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800  mx-auto h-fit">
                                                {{$genre->genre_name}}
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    @php
                                    $user = auth()->user();
                                 @endphp
                                 @if ($story->user_id == $user->id)
                                 
                                     <a href="/story/{{ $story->id }}/edit">
                                        <div class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 h-fit w-fit" name="edit">edit</div>
                                    </a>
                                     

                                @endif
                                   

                                </div>
                                
                                
                            </div>

                        </div>
                    </div>
                    <div class=" p-5 border border-gray-300 rounded-lg bg-white justify-normal dark:bg-gray-800 dark:border-gray-600 lg:max-w-2xl xl:max-w-4xl mx-auto ">
                        <di class=" text-lg font-medium text-gray-900 dark:text-white">
                            {!! $story->body !!}
                        </div>
                        
                    </div>
                </div>
        </form>
    </main>
    <x-footer/>
</body>
</html>