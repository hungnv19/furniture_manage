<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public User $user;
    public Customer $customer;
    public Product $product;
    public Category $category;

    public function __construct(User $user, Customer $customer, Product $product, Category $category)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->user = $user;
        $this->category = $category;
    }
    public function index()
    {
        $product = Product::count();
        $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.category_name as categories_name')
            ->get();
        $user = User::count();
        $category = Category::count();
        // $customer = Customer::count();
        return view('dashboard', [
            'title' => 'Trang quản trị',
            // 'customer' => $customer,
            'products' => $products,
            'product' => $product,
            'user' => $user,
            'category' => $category,
        ]);
    }
}
