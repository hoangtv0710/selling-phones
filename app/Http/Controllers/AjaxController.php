<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductType;
class AjaxController extends Controller
{
    public function getProductType(Request $request)
    {
        $product_type = ProductType::where('cate_id',$request->cate_id)->get();
        return response()->json($product_type,200);

    }
}
