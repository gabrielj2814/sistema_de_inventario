<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
</head>
<body>
    <h1>Hola mundo con laravel 12</h1>
    <a href="{{route("autor.post.formuarlio",["autor_id" =>$autor_id])}}">Crear Post</a>
    <a href="{{route("autor.post.id", ["autor_id" => $autor_id, "post_id" => 100])}}">ir a post id</a>
</body>
</html>
