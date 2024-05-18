<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="assets/vendor/ckeditor5/build/ckeditor.js"></script>
    <title>Document</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <x-navbar/>
        <main class="mt-20">
            <h2>NEW POST</h2>
            <form enctype="multipart/form-data" action="/upload-post" method="POST" class="grid ">
                @csrf
                <div class="p-10 grid max-w-sm bg-slate-100 rounded">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mb-2 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    {{-- foto cover --}}
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="story_cover">Upload Cover</label>
                    <input class="block w-full text-sm mb-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" name="cover" id="cover" type="file">
                    <label for="editor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your story</label>
                    {{-- text editor --}}
                    <div class="mb-2">
                            <textarea name="body" id="editor"></textarea>
                    </div>
                    
                </div>
                <div style="background-color: aquamarine; margin:5px; text-color:black">
                    @foreach ($genres as $genre)
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}"> {{ $genre->genre_name }}<br>
                    @endforeach
                </div>
                <button>Upload</button>
            </form>
        </div>
        </main>
        
    {{-- script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>