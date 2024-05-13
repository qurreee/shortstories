<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="background: gray; margin:10px">
        <h2>NEW POST</h2>
        <form action="/upload-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title">
            <textarea name="body" placeholder="Write your story..."></textarea>
            <button>Upload</button>
        </form>
    </div>
</body>
</html>