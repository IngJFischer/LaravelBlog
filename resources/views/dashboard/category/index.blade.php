@extends('dashboard.layout')

@section('content')

<a class="btn btn-success my-3" href="{{route("category.create")}}">Crear</a>

<table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($category as $c)
        <tr>
            <td>{{$c->slug}}</td>
            <td>
                {{-- Pasamos las rutas a las acciones edit show y destroy --}}
                {{-- Esta es la forma mas sencilla de pasar estas rutas
                <a href="{{route("post.edit", $p)}}"></button></a>
                <a href="{{route("post.show", $p)}}">Mostrar</a>
                Para pasarlas como botones en HTML tenemos que hacer esto --}}
                <form class="inline-block" action="{{route('category.edit', $c)}}">
                    <button class = "btn btn-primary my-2" type="submit">Editar</button>
                </form>

                <form class="inline-block" action="{{route('category.show', $c)}}">
                    <button class = "btn btn-warning my-2" type="submit">Ver</button>
                </form>

                {{--Para destroy tenemos que hascer una peticion de tipo "POST" pero con el metodo "DELETE"--}}
                <form class="inline-block" action="{{route('category.destroy', $c)}}" method="post">
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
{{$category->links()}}

@endsection