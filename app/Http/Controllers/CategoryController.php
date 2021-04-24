<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(Request $request)
    {
        $data = Category::query()
            ->leftJoin('categories as parent','categories.parent_id','=','parent.id')
            ->selectRaw('categories.*, parent.name as parent_name')
            ->orderByDesc('id')
            ->simplePaginate(5);
        return view('admin.category.index')->with('data', $data);
    }

    function add()
    {
        $categories = Category::query()->where('parent_id', 0)->get();
        return view('admin.category.add', ['categories' => $categories]);
    }

    function save(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->desc = $request->desc;
        if($category->save()){
            return redirect()->route('list-category');
        }
        return back();
    }
}
