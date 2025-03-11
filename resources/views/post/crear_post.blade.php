<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <form action="{{route("autor.post.crear",["autor_id" => $autor_id])}}" method="post">
        @method("POST")
        @csrf
        <input type="hidden" name="autor_id" value={{$autor_id}}>
        <div> nombre: <input type="text" name="titulo" id="tituloiId">  </div>
        <div> contenido:  </div>
        <textarea name="contenido" id="contenidoId" cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar">

    </form>

</body>
</html>
