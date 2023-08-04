<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    private $indexRoute = 'dashboard.product-category';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product-category', ['categories' => ProductCategory::all()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        ProductCategory::create(['name' => $request->name]);

        return redirect()->route($this->indexRoute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $productCategory->name = $request->name;
        $productCategory->save();

        return redirect()->route($this->indexRoute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route($this->indexRoute);
    }
}
