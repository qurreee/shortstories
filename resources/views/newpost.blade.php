<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <x-navbar/>
        <main class="mt-20">
            <h2>NEW POST</h2>
            <form enctype="multipart/form-data" action="/upload-post" method="POST">
                @csrf
                <div class="m-10 grid">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" id="title" name="title" placeholder="title" class="mb-5 w-48">
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Write your story!</label>
                    <textarea name="body" id="body" placeholder="Write your story..."></textarea>
                    {{-- foto profil --}}
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload Cover</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" name="cover" id="cover" type="file">
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
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>