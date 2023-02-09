<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::paginate(5);
        return response()->json($data, 200);
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->all()));
    }
    
    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    public function update(PutRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('Post Elminado', 200);       
    }

}
