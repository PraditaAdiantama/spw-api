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
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return response()->json('Succesfully Created');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = Product::find($id);
        $data->update($request->validated());
        return response()->json('Successfully Update');
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return response()->json('Succesfully Deleted');
    }
}
