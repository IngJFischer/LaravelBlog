@extends('dashboard.layout')

@section('content')
    
<h1> Crear Post </h1>

@include('dashboard.fragments._errors-form')

    <br>

    {{--La ruta que pasamos a continuación es del PostController.store--}}
    <form action="{{route('post.store')}}" method="post">
        
        @include('dashboard.fragments._form')

    </form> 

@endsection