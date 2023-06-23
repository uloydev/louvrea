<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('cat') and $request->cat != 'all') {
            $cat = ProductCategory::find($request->cat);
            if (!$cat) {
                abort(404);
            }
            $products = Product::where('product_category_id', $request->cat)->get();
        } else {
            $cat = null;
            $products = Product::all();
        } 

        return view('product-list', ['products' => $products, 'cat' => $cat]);

    }

    public function adminIndex()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    public function detail(Product $product)
    {
        return view('product-detail', ['product'=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
