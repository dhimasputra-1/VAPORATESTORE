<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate(['category_name' => 'required']);
        return Category::create($request->all());
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
