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
    
    <main class="mt-20 min-h-screen max-w-full bg-white dark:bg-gray-900 justify-center content-start">
        <div class="container mx-auto mb-10">
            <h1 class=" text-center mt-10 mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">{{ $genrename }}</h1>
        </div>

        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mx-auto container justify-items-strecth">
                    
                @foreach ($stories as $story)
                <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="/story/{{$story['id']}}">
                        @if ($story->cover && $story->cover !== 'null')
                        <img class="rounded-t-lg hidden sm:block object-cover max-h-56 object-center w-full" src="{{asset('storage/photo/picfolder/'.$story->cover)}}" alt="" />
                        @else
                        <img class="rounded-t-lg hidden sm:block object-scale-down max-h-56 object-center w-full" src="{{URL('storage/photo/webresource/book_landing.png')}}" alt="" />
                        @endif
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
    </main>

    <x-footer/>
    @stack('search')
</body>
</html>