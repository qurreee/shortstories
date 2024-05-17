<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css','resources/js/app.js')
    <title>Home</title>
</head>
<body>
    <x-navbar/>
    <section class="bg-white dark:bg-gray-900 w-screen h-screen flex justify-center items-center">
        <div class="grid w-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 container">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Healthy Habit Healthy Life</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Free short stories written by people all around the world, just for you! Now written digitally, Read from Anywhere!</p>
                <a href="/create-post" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900 mb-3">
                    Write My Story
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                    <button id="scroll" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Browse Stories</button>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:block">
                <img src="{{URL('storage/webresource/book_landing.png')}}" alt="mockup">
            </div>
        </div>
    </section>
   {{-- popular --}}
    <section id="target" class="pt-20">
        <div>
            <div class="container mx-auto">
                <h1 class=" text-center mb-10 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Popular Stories</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container">
                
                @foreach ($topstories->take(5) as $story)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{URL('storage/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="flex-grow p-5 flex flex-col">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($story->body, 100) }}...</p>
                        <div class="mt-auto">
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        </div>
    </section>
    {{-- new story --}}
    <section class="pt-20">
        <div>
            <div class="container mx-auto">
                <h1 class=" text-center mb-10 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Freshly Written</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container">
                
                @foreach ($stories->take(5) as $story)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{URL('storage/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($story->body, 100) }}...</p>
                        <div class="mt-auto">
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        </div>
    </section>
    <section class="pt-20">
        <div>
            <div class="container mx-auto">
                <h1 class=" text-center mb-10 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Top {{$genre1}}s</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container">
                
                @foreach ($genres1->take(5) as $story)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{URL('storage/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($story->body, 100) }}...</p>
                        <div class="mt-auto">
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        </div>
    </section>
    <section class="pt-20">
        <div>
            <div class="container mx-auto">
                <h1 class=" text-center mb-10 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Top {{$genre2}}s</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container">
                
                @foreach ($genres2->take(5) as $story)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{URL('storage/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($story->body, 100) }}...</p>
                        <div class="mt-auto">
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        </div>
    </section>
    <section class="pt-20">`
        <div>
            <div class="container mx-auto">
                <h1 class=" text-center mb-10 text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Top {{$genre3}}s</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mx-auto mb-20 container">
                
                @foreach ($genres3->take(5) as $story)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{URL('storage/webresource/book_landing.png')}}" alt="" />
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <a href="/story/{{$story['id']}}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$story->title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($story->body, 100) }}...</p>
                        <div class="mt-auto">
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        </div>
    </section>
    

    <x-footer/>

    {{-- script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        document.getElementById('scroll').addEventListener('click', function() {
        var targetElement = document.getElementById('target');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    });
    </script>
</body>
</html>