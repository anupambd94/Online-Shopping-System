<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Subcategory;

class ViewController extends Controller
{
    /**
     * Show the application index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::with('category', 'subcategory')->orderBy('id', 'desc')->paginate(12);
    	$categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::with('product')->orderBy('subcategory', 'asc')->get();

        return view('welcome', compact('products', 'categories', 'subcategories'));
    }

    public function categoryProducts($id)
    {
        $products = Category::where('id',$id)->with('product')->orderBy('id', 'desc')->get();
        $categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::with('product')->orderBy('subcategory', 'asc')->get();

        return view('categoryProducts', compact('products', 'categories', 'subcategories'));
    }

    public function subcategoryProducts($category,$id)
    {
        $products = Product::where('category',$category)->where('subcategory', $id)->orderBy('id', 'desc')->get();
        $categories = Category::orderBy('category', 'asc')->get();
        $subcategories = Subcategory::with('product')->orderBy('subcategory', 'asc')->get();

        return view('subcategoryProducts', compact('products', 'categories', 'subcategories'));
    }
}
