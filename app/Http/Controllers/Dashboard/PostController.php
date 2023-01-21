<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //La función pluck extrae valores de la tabla y los entrega como un array 'key','value'
        //(en ese orden)
        $categories = Category::pluck('title','id');
        $post = Post::paginate(2);
        //dd($categories->all());
        return view('dashboard.post.index',compact('post','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Una forma de obtener los valores de las tablas de 'categories' es la siguiente
        //$categories = Category::get();    //Esto devuelve todas las columnas de la tabla
        //Como solo necesitamos dos valores: 'id' y 'title' usaremos lo siguiente (devuelve un array):

        $categories = Category::pluck('id','title');
        $post = new Post();
        
        //dd($post);
        //Función de debug. Muestra un elemento del array obtenido con Category::get
        //dd($categories[0]->title);

        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //La validación de datos es hecha mediante la clase StoreRequest.
        //Para una validación local podemos hacer $validated = Validator::make($request->all(), Reglas);
        //Validator es una clase de Facades
       
        //dd($request->all());
        //Creamos el registro en la base de datos
        Post::create($request->all());

        //Redirecionamos al index
        return to_route("post.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::pluck('id','title');

        return view('dashboard.post.show', compact('categories', 'post'));

        //return "Show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id','title');

        return view('dashboard.post.edit', compact('categories', 'post'));
        //return "Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PutRequest $request, Post $post)
    {
        //Guardamos los datos
        $post->update($request->validated());

        //Redirecionamos al index
        return to_route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Eliminamos el registro
        $post->delete();
        
        //Redireccionamos al index
        return to_route("post.index");
    }
};