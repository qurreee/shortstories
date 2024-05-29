<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
     @vite(['resources/css/app.css','resources/js/app.js' ])
    <title>ShortStories</title>
</head>


  
<body>
    {{-- navbar --}}
    <x-navbar/>
    
    <header class="container h-screen max-w-full bg-blue-100 dark:bg-gray-900 flex justify-center items-center">
        <div class="md:p-10 md:mx-auto container flex gap-10 justify-center items-center">
            <div class="mx-auto hidden md:block ">
                <h1 class="text-3xl font-bold md:text-5xl dark:text-white">Write Stories, Read Stories</h1>
                <p class="text-lg md:text-xl dark:text-gray-400">you can write or read short stories, start your writing journey here!</p>
            </div>
            
            {{-- login form --}}
            <form action="/register" method="POST" class="bg-blue-200 dark:bg-gray-600 min-w-80 p-10 rounded mx-auto">
                @csrf
                <h3 class="text-2xl font-semibold text-center mb-3 dark:text-white">Register</h3>
                <div class="mb-3">
                    
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus/>
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
                <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign Up</button>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Already have an account? <a href="/" class="font-medium text-blue-600 hover:underline dark:text-blue-500 text-nowrap">Login</a></p>
            </form>
        </div>
    </header>
    
    
        
    {{-- script --}}
</body>
</html>