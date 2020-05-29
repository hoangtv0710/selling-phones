<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;

class ClientController extends Controller
{
    public function __construct()
    {
        $category = Category::where('status', 1)->get();
        $product_type = ProductType::where('status', 1)->get();
        View::share(['category' => $category, 'product_type' => $product_type]);
    }

    public function index()
    {
        $new_product = Product::where('status', 1)->orderBy('id', 'desc')->limit(6)->get();
        $promotional_product = Product::where('status', 1)->where('promotional', '>', 0)->limit(6)->get();
        return view('client.pages.index', compact('new_product', 'promotional_product'));
    }
}
