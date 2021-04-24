<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(Request $request)
    {
//        $data = Category::query()
//            ->leftJoin('categories as parent','categories.parent_id','=','parent.id')
//            ->selectRaw('categories.*, parent.name as parent_name')
//            ->orderByDesc('id')
//            ->simplePaginate(5);
        $categories = Category::query()->paginate('5');
        $parent = Category::query()->where('parent_id',0)
            ->select(['id','name'])->get()->keyBy('id')->toArray();
        return view('admin.category.index', compact('categories','parent'));
    }

    function add()
    {
        $categories = Category::query()->where('parent_id', 0)->get();
        return view('admin.category.add', ['categories' => $categories]);
    }

    function update($id){
        $categories = Category::query()->where('parent_id', 0)->get();
        $category = Category::find($id);
        if(!$category)
            abort(404);
        return view('admin.category.update', compact('category','categories'));
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

    function save_update($id, Request $request){
       $category = Category::find($id);
       if($category){
           $category->update([
               'name'=>$request->name,
               'desc'=>$request->desc,
               'parent_id'=>$request->parent_id
           ]);
           return redirect()->route('list-category');
       }else{
           abort('404');
       }
    }
    function delete($id){
        $category = Category::find($id);
        $count = Category::where('parent_id',$id)->count();

        if($category && $count==0){
            $category->delete();
            $msg = 'Đã xóa thành công';
        }else{
            $msg = 'Xóa thất bại';
        }
        return redirect()->route('list-category')->with('msg',$msg);
    }
}
