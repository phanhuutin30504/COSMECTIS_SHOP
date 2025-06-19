<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $featuredProducts  = Product::where('featured', 1)->limit(8)->get();
        $newProducts = Product::orderBy('created_at', 'DESC')->limit(8)->get();
        $categories = Category::whereHas('products')->with('products')->get();
        // dd($categories->toArray());
        return view('home.index', [
            'products' => $featuredProducts,
            'newProducts'=>$newProducts,
            'categories' => $categories
        ]);
    }
    public function search(Request $request)
    {
        if($request->ajax()) {
            $query = $request->get('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();

            return response()->json($products);
        }
    }
}
