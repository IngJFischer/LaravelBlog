@extends('dashboard.layout')

@section('content')
    
<h1> Editar Post: {{$post->title}} </h1>

@include('dashboard.fragments._errors-form')

    <br>

    {{--La ruta que pasamos a continuación es del PostController.store--}}
    <form action="{{route('post.update', $post->id)}}" method="post">
        
        {{--El siguiente comando es para validar la petición desde el backend (csrf protection)--}}
        @csrf
        
        {{--Este es el método que utilizaremos para enviar los datos a la base de datos--}}
        @method("PUT") {{--Tambien puede ser "PATCH"--}}

        <label for="">Título</label>
        <input type="text" name="title" value="{{$post->title}}">
        
        <label for="">Slug</label>
        <input readonly type="text" name="slug" value="{{$post->slug}}">
        
        <label for="">Categoría</label>
        <select name="category_id">
            <option value=""></option>
            @foreach ($categories as $title => $id)
            {{--Colocamos un condicional corto para mostrar el valor de categoría--}}
            <option {{$post->category_id == $id ? 'selected' : ''}} value="{{$id}}">{{$title}}</option>                
            @endforeach
        </select>
        
        <label for="">Posteado</label>
        <select name="posted">
            <option {{$post->posted == 'no' ? 'selected' : ''}} value="no">No</option>
            <option {{$post->posted == 'yes' ? 'selected' : ''}} value="yes">Si</option>
        </select>
        
        <br>
        
        <label for="">Contenido</label>
        <textarea name="content">{{$post->content}}</textarea>
        
        <br>
        
        <label for="">Descripción</label>
        <textarea name="description">{{$post->description}}</textarea>
        
        <br>
        
        <button type="submit">Enviar</button>
        <p></p>
    </form> 

@endsection