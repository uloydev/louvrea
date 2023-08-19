<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $indexRoute = 'dashboard.product';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('ratings');
        if ($request->search) {
            return view('product-list', [
                'products' => $products->where('name', 'like', '%'.$request->search.'%')->get(),
                'search' => $request->search,
                'cat' => null,
            ]);
        }

        if ($request->has('cat') and $request->cat != 'all') {
            $cat = ProductCategory::find($request->cat);
            if (!$cat) {
                abort(404);
            }
            $products = $products->where('product_category_id', $request->cat)->get();
        } else {
            $cat = null;
            $products = $products->get();
        }

        return view('product-list', ['products' => $products, 'cat' => $cat, 'search' => null]);
    }

    public function adminIndex()
    {
        return view('admin.product', [
            'products' => Product::all(),
            'categories' => ProductCategory::all(),
        ]);
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
        $this->validateForm($request);

        $path = $request->file('image')->store('product-image', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path,
            'size' => $request->size,
            'stock' => $request->stock,
            'product_category_id' => $request->category,
        ]);

        return redirect()->route($this->indexRoute);
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
        return view('product-detail', ['product' => $product]);
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
        $this->validateForm($request);

        $path = $request->file('image')->store('product-image', 'public');

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $path;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->product_category_id = $request->category;

        $product->save();

        return redirect()->route($this->indexRoute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route($this->indexRoute);
    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'size' => 'required|string',
            'stock' => 'required|numeric',
            'category' => 'required|numeric',
        ]);
    }
}
