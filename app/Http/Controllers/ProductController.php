<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Catalog;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $catalogName = $request->input('catalog');
            $catalog = Catalog::where('name', $catalogName)->with('products')->first();
            $products = $catalog->products;

            return response()->json([
                "products" => $products,

            ]);
        } catch (Exception $ex) {
            return response()->json([
                'products' => Product::all()
            ]);
        }
    }

    public function show($id)
    {
        $product = Product::with('catalog')->find($id);
        return response()->json([
            'product' => $product,
        ]);
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
        return response()->noContent();
    }
}
