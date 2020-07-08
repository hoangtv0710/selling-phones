<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Category;
use Carbon\Carbon;
use App\Http\Requests\ProductRequest;
use File;
use Validator;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $imageService;
    public function __construct(ImageService $image_Service) {
        $this->imageService = $image_Service;
    }

    public function index()
    {
        $product = Product::where('status',1)->paginate(10);
        return view('admin.pages.product.list',compact('product'));
    }

  
    public function create()
    {
        $category = Category::where('status',1)->get();
        $product_type = ProductType::where('status',1)->get();
        return view('admin.pages.product.add', compact('category', 'product_type'));
    }

   
    public function store(ProductRequest $request)
    {
        if($request->hasFile('image')){
           $file  = $request->image;
           if($this->imageService->checkFile($file) == 1) {
                $fileName = $this->imageService->moveFile('images/products/', $file);
                if($fileName != 0) {
                    $data = $request->all();
                    $data['slug'] = utf8tourl($request->name);
                    $data['image'] = $fileName;
                    Product::create($data);
                    return redirect()->route('product.index')->with('thongbao', 'Thêm thành công');
                }
           } elseif($this->imageService->checkFile($file) == 0) {
                return back()->with('error', 'Ảnh phải dưới 1mb');
           } else {
                return back()->with('error', 'File bạn chọn không phải là ảnh');
           }
        }
    }

    public function edit($id)
    {
        $category = Category::where('status',1)->get();
        $product_type = ProductType::where('status',1)->get();
        $product = Product::find($id);
        return response()->json(['category' => $category, 'product_type' => $product_type, 'product' => $product],200);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($request->hasFile('image')){
            $file  = $request->image;
           if($this->imageService->checkFile($file) == 1) {
                $fileName = $this->imageService->moveFile('images/products/', $file);
                if($fileName != 0) {
                    $data['image'] = $fileName;
                }
           } elseif($this->imageService->checkFile($file) == 0) {
                return response()->json(['success' => 'Ảnh phải dưới 1mb'], 200);
           }
        } else {
            $data['image'] = $product->image;
        }
        $this->imageService->deleteFile('images/products/', $product->image);
        $product->update($data);
        return response()->json(['success' => 'Sửa thành công'], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $this->imageService->deleteFile('images/products/', $product->image);
        $product->delete();
        return response()->json(['success' => 'Xoá thành công'], 200);
    }
}


