<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>post ID</title>
</head>
<body>

    <h1>id post : {{$post_id}}</h1>

    @if ($post_id=="1")
        <h2>Ula</h2>
    @endif
    @if ($post_id=="2")
        <h2>Ula 2</h2>
    @endif

   {{-- <ul>
        @if (count($lista)>0)
            @foreach ($lista as $numero)
                <li>{{$numero}}</li>
            @endforeach
        @endif
    </ul> --}}

    <a href="{{route("autor.index",["autor_id" => $autor_id])}}">regresar</a>


</body>
</html>
