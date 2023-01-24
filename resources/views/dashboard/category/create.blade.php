@extends('dashboard.layout')

@section('content')
    
<h1> Crear Categoría </h1>

@include('dashboard.fragments._errors-form')

    <br>

    {{--La ruta que pasamos a continuación es del PostController.store--}}
    <form action="{{route('category.store')}}" method="post">
        
        @include('dashboard.fragments._categoryform')

    </form> 

@endsection