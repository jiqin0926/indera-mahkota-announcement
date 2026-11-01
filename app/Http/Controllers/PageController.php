<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $username = 'Jiqin';
        return view('home', compact('username'));
    }
    public function products()
    {
        $products = Product::all(); // fetch from DB
        return view('products', compact('products'));
    }       
    public function create()
    {
    return view('create_product');
    }
}
