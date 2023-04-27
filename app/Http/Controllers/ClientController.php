<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {

        return view('client.layouts.main');
    }
    public function shop()
    {
        $products = Product::select('products.*')
            ->orderBy('product_name')->with('categories')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();
        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function searchProduct(Request $requests)
    {
        $products= Product::where('product_name', 'like', '%' . $requests->name . '%')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();

        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function categoryProducts($id)
    {
        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*')
            ->where('products.category_id', '=', $id)
            ->paginate(12);
        $categories = Category::select('id', 'category_name')->get();


        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
}
