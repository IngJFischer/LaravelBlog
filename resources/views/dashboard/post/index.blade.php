@extends('dashboard.layout')

@section('content')

<a class="btn btn-success my-3" href="{{route("post.create")}}">Crear</a>

<table class="table">
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
            <td class="table-cell text-center">{{$p->Category['title']}}</td>
            <td class="table-cell text-center">{{$p->posted}}</td>
            <td class="table-cell text-center">
                {{-- Pasamos las rutas a las acciones edit show y destroy --}}
                {{-- Esta es la forma mas sencilla de pasar estas rutas
                <a href="{{route("post.edit", $p)}}"></button></a>
                <a href="{{route("post.show", $p)}}">Mostrar</a>
                Para pasarlas como botones en HTML tenemos que hacer esto --}}
                <form class="inline-block object-right" action="{{route('post.edit', $p)}}">
                    <button class = "btn btn-primary my-2" type="submit">Editar</button>
                </form>

                <form form class="inline-block" action="{{route('post.show', $p)}}">
                    <button class = "btn btn-warning my-2" type="submit">Ver</button>
                </form>

                {{--Para destroy tenemos que hascer una peticion de tipo "POST" pero con el metodo "DELETE"--}}
                <form form class="inline-block" action="{{route('post.destroy', $p)}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button class = "btn btn-danger my-2" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

{{--Para la paginación automática de laravel hacemos lo siguiente Posts::paginate en controlador--}}
{{$post->links()}}

@endsection