<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('catalog')->get();
        return response()->json([
            "products" => $product
        ], 200);
    }

    public function show($id)
    {
        $product = Product::with('catalog')->find($id);
        return response()->json([
            'product' => $product,
        ], 200);
    }

    public function store(ProductRequest $request)
    {
        $products = $request->all();
        Product::create($products);
        return response()->json([
            'product' => $products
        ], 201);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->validated());
        return response()->json([
            'product' => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product,204);
    }
}
