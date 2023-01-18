<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        
        //Función de debug. Muestra un elemento del array obtenido con Category::get
        //dd($categories[0]->title);

        return view('dashboard.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //Función de debug que muestra los valores del $request de forma amigable//
        //dd($request);//
        //dd($request->all());//

        //La validación de datos es hecha mediante la clase StoreRequest.
        //Para una validación local podemos hacer $validated = Validator::make($request->all(), Reglas);
        //Validator es una clase de Facades
       
        //dd($request->all());
        //Creamos el registro en la base de datos
        Post::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
