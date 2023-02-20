<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::with('category')->paginate(5);
        return response()->json($data, 200);
    }

    public function all()
    {
        $data = Post::get();
        return response()->json($data, 200);
    }

    public function slug(Post $post) //$slug
    {
        //$post = Post::with('category')->where('slug', $slug)->FirstorFail();
        $post->category;
        return response()->json($post, 200);
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

    public function upload(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10240'
        ]);

        Storage::disk('public_upload')->delete("image/otro/".$post->image);

        $data['image'] = $filename = time()."." . $request['image']->extension();
        $request->image->move(public_path("image/otro"),$filename);
        
        $post->update($data);
      
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('Post Elminado', 200);       
    }

}
