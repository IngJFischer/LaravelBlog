@extends('dashboard.layout')

@section('content')
    
<h1> Editar Post: {{$post->title}} </h1>

@include('dashboard.fragments._errors-form')

    <br>

    {{--La ruta que pasamos a continuación es del PostController.store--}}
    <form action="{{route('post.update', $post->id)}}" method="post">
        
        {{--Este es el método que utilizaremos para enviar los datos a la base de datos--}}
        @method("PUT") {{--Tambien puede ser "PATCH"--}}
        
        @include('dashboard.fragments._form')        

    </form> 

@endsection