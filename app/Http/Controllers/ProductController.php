<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['category', 'tags'])
            ->active()
            ->inStock()
            ->when($request->filled('category'), fn ($q) => $q->whereRelation('category', 'slug', $request->string('category')->toString()))
            ->when($request->filled('q'), fn ($q) => $q->search($request->string('q')->toString()))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'tags', 'user']);

        return view('products.show', compact('product'));
    }
}
