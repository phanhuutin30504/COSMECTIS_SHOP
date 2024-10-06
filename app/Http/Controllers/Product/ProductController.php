<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $query = Product::query();
        $query = $this->sortProducts($query, $sort);
        // dd($query);
        $categoryId = $request->input('category');
        $priceRange = $request->input('filter-price');
        if ($priceRange) {
            $products = $this->filterByPrice($priceRange);
            $category = null;
        } elseif ($categoryId) {
            $query->where('category_id', $categoryId);
            $products = $query->paginate(12);
            $category = Category::findOrFail($categoryId);
        } else {
            $products = $query->paginate(12);
            $category = null;
        }
        $categories = Category::all();
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'sort' => $sort
        ]);
    }
    // sắp xếp theo giá
    public function filterByPrice($priceRange)
    {
        $priceParts = explode('-', $priceRange);
        $minPrice = $priceParts[0];
        $maxPrice = $priceParts[1] === 'greater' ? PHP_INT_MAX : $priceParts[1];
        return Product::whereBetween('price', [$minPrice, $maxPrice])->paginate(9);
    }
    //sắp xếp tăng giảm
    public function sortProducts($query, $sort)
    {
        switch ($sort) {
            case 'price-asc':
                return $query->orderBy('price', 'asc');
            case 'price-desc':
                return $query->orderBy('price', 'desc');
            case 'created-asc':
                return $query->orderBy('created_at', 'asc');
            case 'created-desc':
                return $query->orderBy('created_at', 'desc');
            case 'alpha-asc':
                return $query->orderBy('name', 'asc');
            case 'alpha-desc':
                return $query->orderBy('name', 'desc');
            default:
                return $query;
        }
    }
    public function detail($id)
    {
        $product = Product::with(
            ['brand', 'category', 'comments' => function ($query) {
                $query->orderBy('id', 'DESC')
                    ->limit(5);
            }, 'images']
        )->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Tránh sản phẩm hiện tại
            ->get();
        return view('products.detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
