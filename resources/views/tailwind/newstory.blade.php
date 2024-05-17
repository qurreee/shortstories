<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="assets/vendor/ckeditor5/build/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
        min-height: 500px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <x-navbar/>
    <div class="w-screen bg-white dark:bg-teal-950 justify-center items-center">
        <main>
            <div class="container mx-auto mt-20 mb-10">
                <h1 class=" text-center mb-10 text-4xl sm:text-5xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Write New Story</h1>
            </div>


                <form enctype="multipart/form-data" action="/upload-post" method="POST">
                    @csrf
                    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0" >
                        <div class="mt-6 sm:mt-8 justify- center md:gap-6 lg:flex lg:items-start xl:gap-8">
                            <div class=" w-max mx-auto">
                                <div class="max-w-sm  justify-end">
                                    <div>
                                        <label for="title" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Title</label>
                                        <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mb-5 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                                    </div>
                                    <div>
                                        {{-- foto cover --}}
                                        <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-white" for="cover">Upload Cover</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" name="cover" id="cover" type="file">
                                    </div>
                                </div>
                                <div class="max-w-sm ">
                                    <label class="mb-2 mx-auto sm:justify-center text-lg font-medium text-gray-900 dark:text-white">Genres</label>
                                    <div class="mx-auto sm:mx-0 py-5 px-10 mb-5 border border-gray-300 rounded-lg bg-white">
                                        @foreach ($genres as $genre)
                                        <div class="flex items-center mb-2">
                                            <input id="checkbox{{ $genre->id }}" name="genres[]" type="checkbox" value="{{ $genre->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                            <label for="checkbox{{ $genre->id }}" class="ms-5 text-lg font-medium text-gray-900 dark:text-gray-300">{{ $genre->genre_name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                                <label for="editor" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Your story</label>
                                <div class=" p-5 border border-gray-300 rounded-lg bg-white justify-normal">
                                        <textarea name="body" id="editor"></textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                        {{-- text editor --}}
                        
                        
                        
                   

                    

                    <button>Upload</button>

                </form>
            </div>
        </main>
    <x-footer/>
    {{-- script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(editor => {
            // Set initial content with multiple lines
            editor.ui.view.editable.element.style.height = '500px';
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>