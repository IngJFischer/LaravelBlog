<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $data = Category::paginate(10);
        return response()->json($data, 200);
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Category::create($request->all()));
    }

    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('Categoría Eliminada', 200);
    }
}
