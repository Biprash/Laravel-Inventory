<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductQuantityRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(ProductResource::collection(Product::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return response()->json('Created Product Sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('Deleted Product Successfully');
    }

    /**
     * Purchase Product
     * @param ProductQuantityRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function purchase(ProductQuantityRequest $request, Product $product)
    {
        $product->quantity = $product->quantity + $request->quantity;
        $product->save();
        return response()->json('Purchased ' . $request->quantity . ' quantity of ' . $product->name . ' Successfully');
    }

    /**
     * Purchase Product
     * @param ProductQuantityRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function sale(ProductQuantityRequest $request, Product $product)
    {
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();
        return response()->json('Sold ' . $request->quantity . ' quantity of ' . $product->name . ' Successfully');
    }
}