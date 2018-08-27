<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$products = Product::where('name', 'LIKE', '%'.$request->keyword.'%')->get();

    	$categories = Category::orderBy('category', 'asc')->get();
    	return view('search', compact('categories', 'products'));
    }
}
