@extends('dashboard.layout')

@section('content')
    
<h1> Crear Post </h1>

@include('dashboard.fragments._errors-form')

    <br>

    {{--La ruta que pasamos a continuación es del PostController.store--}}
    <form action="{{route('post.store')}}" method="post">
        
        {{--El siguiente comando es para validar la petición desde el backend (csrf protection)--}}
        @csrf
        
        <label for="">Título</label>
        <input type="text" name="title">
        
        <label for="">Slug</label>
        <input type="text" name="slug">
        
        <label for="">Categoría</label>
        <select name="category_id">
            <option value=""></option>
            {{--Si usamos la opción Categories::get, debemos hacer el siguiente foreach }}
            @foreach ($categories as $c)
            <option value="{{$c->id}}">{{$c->title}}</option>                
            @endforeach {{--}}
            @foreach ($categories as $title => $id)
            <option value="{{$id}}">{{$title}}</option>                
            @endforeach
        </select>
        
        <label for="">Posteado</label>
        <select name="posted">
            <option value="no">No</option>
            <option value="yes">Si</option>
        </select>
        
        <br>
        
        <label for="">Contenido</label>
        <textarea name="content"></textarea>
        
        <br>
        
        <label for="">Descripción</label>
        <textarea name="description"></textarea>
        
        <br>
        
        <button type="submit">Enviar</button>
        <p></p>
    </form> 

@endsection