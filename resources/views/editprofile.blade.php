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
        <div class=" w-full sm:max-w-xl mx-auto">
            <div class="container mx-auto mb-10">
                <h1 class=" text-center mt-10 mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Edit Profile</h1>
            </div>
            <div class=" flex-none mx-auto lg:max-w-2xl xl:max-w-4x">
                <div class="p-10 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                    <div class="flex items-center gap-8 mb-5">
                        @if ( $userprofile->pic != null && $userprofile->pic)
                        <img class="rounded-full w-36 h-36 ring-8 ring-gray-300 dark:ring-gray-500" src="{{asset('storage/photo/profilepic/'). auth()->user()->pic}}" alt="Bordered avatar">
                        @else
                        <img class="rounded-full w-20 h-20 ring-2 ring-gray-300 dark:ring-gray-500" src="{{ URL('storage/photo/webresource/pp.jpeg') }}" alt="Bordered avatar">
                        @endif
                        
                        <div class=" text-3xl font-extrabold text-gray-900 dark:text-gray-300">
                            <div class="text-lg font-bold text-gray-700 dark:text-gray-400 ">{{ $userprofile->email }}</div>
                        </div>

                        {{-- <div class="ml-auto">
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save Changes</button>
                        </div> --}}
                    </div>
                    <div>
                        <form enctype="multipart/form-data" action="/profile/{{ $userprofile->name }}/edit" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label for="editname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input type="text" id="editname" name="editname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2" value="{{ $userprofile->name }}"/>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="editpic">Change Profile Picture</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="editpic" name="editpic" type="file">
                            </div>
                            <div class="mb-5">
                                <label for="editprofile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile</label>
                                    <textarea id="editprofile" name="editprofile" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >{{ $userprofile->profile }}</textarea>
                            </div>
                            <div>
                                
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save Changes</button>
                                
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer/>
</body>
</html>