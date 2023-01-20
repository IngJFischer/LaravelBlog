@extends('dashboard.layout')

@section('content')

<a href="{{route("post.create")}}">Crear</a>

<h1>Index</h1>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoría</th>
            <th>Posteado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($post as $p)
        <tr>
            <td>{{$p->title}}</td>
            <td>{{$categories[$p->category_id]}}</td>
            <td>{{$p->posted}}</td>
            <td>
                {{-- Pasamos las rutas a las acciones edit show y destroy --}}
                {{-- Esta es la forma mas sencilla de pasar estas rutas
                <a href="{{route("post.edit", $p)}}"></button></a>
                <a href="{{route("post.show", $p)}}">Mostrar</a>
                Para pasarlas como botones en HTML tenemos que hacer esto --}}
                <form action="{{route('post.edit', $p)}}">
                    <button type="submit">Editar</button>
                </form>

                <form action="{{route('post.show', $p)}}">
                    <button type="submit">Ver</button>
                </form>

                {{--Para destroy tenemos que hascer una peticion de tipo "POST" pero con el metodo "DELETE"--}}
                <form action="{{route('post.destroy', $p)}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

{{--Para la paginación automática de laravel hacemos lo siguiente Posts::paginate en controlador--}}
{{$post->links()}}

@endsection