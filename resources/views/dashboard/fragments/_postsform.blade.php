<!DOCTYPE html>
<body>
    {{--El siguiente comando es para validar la petición desde el backend (csrf protection)--}}
    @csrf

    {{--La función old("valor","valor por defecto") permite almacenar los valores anteriores --}}
    <label for="">Título</label>
    <input type="text" class="form-control" name="title" value="{{old("title", $post->title)}}">

    <label for="">Slug</label>
    <input {{--$post->exists ? "readonly" : ""--}} type="text" class="form-control" name="slug" value="{{old("slug", $post->slug)}}">

    <label for="">Categoría</label>
    <select name="category_id" class="form-control">
        <option value=""></option>
        {{--Si usamos la opción Categories::get, debemos hacer el siguiente foreach }}
        @foreach ($categories as $c)
        <option value="{{$c->id}}">{{$c->title}}</option>                
        @endforeach {{--}}
        @foreach ($categories as $title => $id)
        <option {{old("category_id", $post->category_id) == $id ? "selected" : ""}}
                value="{{$id}}">{{$title}}</option>                
        @endforeach
    </select>

    <label for="">Posteado</label>
    <select name="posted" class="form-control">
        <option {{old("posted", $post->posted) == "no" ? "selected" : ""}} value="no">No</option>
        <option {{old("posted", $post->posted) == "yes" ? "selected" : ""}} value="yes">Si</option>
    </select>

    <br>

    <label for="">Contenido</label>
    <textarea name="content" class="form-control">{{old("content", $post->content)}}</textarea>

    <br>

    <label for="">Descripción</label>
    <textarea name="description" class="form-control">{{old("description", $post->description)}}</textarea>

    <br>

    @if (isset($task) && $task == "edit")
        <label for="">Imagen</label>
        <input class="btn btn-primary" type="file" name="image">
        <br>
    @endif

    <button class="btn btn-success mt-2" type="submit">Enviar</button>
    <p></p>    
</body>
