<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Validator;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $category = Category::paginate(10);
        if($user->can('view', Category::class)){
            return view('admin.pages.category.list',compact("category"));
        } else {
            return view('error.403');
        }
        
    }

    public function create()
    {
        $user = Auth::user();
        if($user->can('create', Category::class)){
            return view('admin.pages.category.add');
        } else {
            return view('error.403');
        }
    }

    public function store(CategoryRequest $request)
    {
        $user = Auth::user();
        if($user->can('create', Category::class)){
            Category::create([
                'name' => $request->name,
                'slug' => utf8tourl($request->name),
                'status' => $request->status
            ]);
            return redirect()->route('category.index');
        } 
    }

    public function edit($id)
    {
        $user = Auth::user();
        if($user->can('update', Category::class)){
            $category = Category::find($id);
            return response()->json($category, 200);
        } 
    }

    public function update(CategoryRequest $request, $id)
    {
        $user = Auth::user();
        if($user->can('update', Category::class)){
            $category = Category::find($id);
            $category->update([
                'name' => $request->name,
                'slug' => utf8tourl($request->name),
                'status' => $request->status
            ]);
            return response()->json(['success' => 'Sửa thành công']);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if($user->can('delete', Category::class)){
            $category = Category::find($id);
            $category->delete();
            return response()->json(['success' => 'Xoá thành công']);
        } 
    }
}
