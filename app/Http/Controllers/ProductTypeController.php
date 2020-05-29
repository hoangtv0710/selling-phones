<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\Category;
use App\Http\Requests\ProductTypeRequest;
use Illuminate\Http\Request;
use Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_type = ProductType::paginate(10);
        return view('admin.pages.product_type.list',compact('product_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        return view('admin.pages.product_type.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)){
            return redirect()->route('product_type.index')->with('thongbao', 'Thêm thành công');
        } else {
            return back()->with('thongbao', 'Có lỗi xảy ra xin kiểm tra lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_type = ProductType::find($id);
        $category = Category::where('status',1)->get();
        return response()->json(['category' => $category, 'product_type' => $product_type],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeRequest $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2|max:255'
            ],
            [
                'required' => 'Tên loại sản phẩm không được để trống',
                'min' => 'Tên dloại sản phẩm tối thiểu 2 kí tự',
                'max' => 'Tên loại sản phẩm tối đa 255 kí tự',
            ]
        );
        if($validator->fails()){
            return response()->json(['error' => 'true', 'message' => $validator->errors()],200);
        }
        $product_type = ProductType::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($product_type->update($data)){
            return response()->json(['success' => 'Sửa thành công'], 200);
        } else {
            return response()->json(['success' => 'Sửa không thành công'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_type = ProductType::find($id);
        if($product_type->delete()){
            return response()->json(['success' => 'Xoá thành công'], 200);
        } else {
            return response()->json(['success' => 'Xoá không thành công'], 200);
        }
    }
}
