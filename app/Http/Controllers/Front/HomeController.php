<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories=Category::with(['parent'])->get()->Active()->whereNull('parent_id')->latest()->limit(6)->get();
        $products=Product::Active()->with(['category'])->latest()->limit(8)->get();
        return view('front.index',compact('categories','products'));
    }
    public function show(Product $product){

        return view('front.products',compact('product'));
    }

}
