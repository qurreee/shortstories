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
    <script src="{{URL('storage/assets/vendor/ckeditor5/build/ckeditor.js')}}"></script>
    <style>
        .ck-editor__editable {
        min-height: 500px;
        }
    </style>
    <title>ShortStories</title>
</head>
<body class="bg-white dark:bg-gray-900">
    <x-navbar/>
    <div class="min-h-screen max-w-full bg-white dark:bg-gray-900 justify-center content-center ">
        <main class="self-center">
            <div class="container mx-auto mb-10">
                <h1 class=" text-center mt-10 mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Write New Story</h1>
            </div>
            <form enctype="multipart/form-data" action="/upload-story" method="POST">
                    @csrf
                    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0" >
                        <div class="my-6 sm:mt-8 justify-center md:gap-6 lg:flex lg:items-start xl:gap-8">
                            <div class=" w-full ">
                                <div class="max-w-sm  justify-end mx-auto">
                                    <div>
                                        <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Title</label>
                                        <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mb-2 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                    </div>
                                    <div>
                                        {{-- foto cover --}}
                                        <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-white" for="cover">Upload Cover</label>
                                        <input class="block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" name="cover" id="cover" type="file">
                                    </div>
                                </div>
                                <div class="max-w-sm mx-auto ">
                                    <label class="mb-2 text-lg font-medium text-gray-900 dark:text-white ">Genres</label>
                                    <div class="mx-auto sm:mx-0 py-5 px-10 mb-5 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600 ">
                                        @foreach ($genres as $genre)
                                        <div class="flex items-center mb-2">
                                            <input id="checkbox{{ $genre->id }}" name="genres[]" type="checkbox" value="{{ $genre->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                            <label for="checkbox{{ $genre->id }}" class="ms-5 text-lg font-medium text-gray-900 dark:text-gray-300">{{ $genre->genre_name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- text editor --}}
                            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                                <label for="editor" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white ">Your story</label>
                                <div class=" p-5 border border-gray-300 rounded-lg bg-white justify-normal dark:bg-gray-800 dark:border-gray-600 ">
                                        <textarea name="body" id="editor"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex my-10">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-1/2 mx-auto">Upload</button>
                        </div>
                    </div>
            </form>

        </main>
    </div>
        
    <x-footer/>
    {{-- script --}}
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ))
            .then(editor => {
            // Set initial content with multiple lines
            editor.ui.view.editable.element.style.height = '500px';
            })
            
            .catch( error => {
                console.error( error );
            } );
    </script>
    @stack('search')
</body>
</html>