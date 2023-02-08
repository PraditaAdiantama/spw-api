<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all()->toArray();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }

    public function store(ProductRequest $request)
    {
        $products = $request->validated();
        Product::create($products);
        return response()->json($products, 201);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = Product::find($id);
        $data->update($request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return response()->json('Succesfully Deleted', 204);
    }
}
