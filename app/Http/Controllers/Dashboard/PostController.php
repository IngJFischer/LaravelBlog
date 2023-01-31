<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Mostramos de a x resultados a la vez
        $post = Post::paginate(3);
        //dd($categories->all());
        return view('dashboard.post.index',compact('post'));
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
        return to_route("post.index")->with('status','Creación exitosa');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //$categories = Category::pluck('id','title');

        return view('dashboard.post.show', compact('post'));

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
        //Definimos la variable temporal $data para trabajar sobre ella y no sobre $request
        $data = $request->validated();

        if (isset($data["image"])){
            //Si hemos cargado una imagen y se valido correctamente hacemos lo siguiente
            //Generamos el nombre de archivo y lo pasamos para guardar en la base de datos
            $data['image'] = $filename = time().".".$data['image']->extension();
            //Movemos el archivo subido al sistema de almacenamiento de laravel
            $request->validated()['image']->move(public_path("image"),$filename);
        }
        
        //Guardamos los datos
        $post->update($data);
        //Esta es una forma de pasar variables que durarán un solo request
        //$request->session()->flash('status','Edición exitosa');
        //Redirecionamos al index
        return to_route("post.index")->with('status','Edición exitosa');
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
        return to_route("post.index")->with('status','Registro eliminado');
    }
};