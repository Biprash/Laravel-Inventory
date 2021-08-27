<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductQuantityRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('products.index', ['products' => Product::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('products.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $attributes = $request->validated();
        if ($request->hasFile('image'))
        {
            $path = $request->image->store('image');
            $attributes['image'] = $path;
        }
        Product::create($attributes);
        return redirect()->route('products.index')->with('message', 'Products has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     */
    public function show(Product $product)
    {
        return view('products.show', [ 'product' => $product]);
    }

    /**
     * Show the form for updating a new resource.
     *
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product, 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $attributes = $request->validated();
        if ($request->hasFile('image'))
        {
            $path = $request->image->store('image');
            $attributes['image'] = $path;
        }
        $product->update($attributes);
        return redirect()->route('products.index')->with('message', 'Products has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Products has been deleted.');
    }

    /**
     * Show the form for purchasing a new resource.
     *
     */
    public function purchaseView(Product $product)
    {
        return view('products.purchase', ['product' => $product]);
    }

    /**
     * Purchase Product
     * @param ProductQuantityRequest $request
     * @param Product $product
     */
    public function purchase(ProductQuantityRequest $request, Product $product)
    {
        $product->quantity = $product->quantity + $request->quantity;
        $product->save();
        return redirect()->route('products.index')->with('message', 'Purchased ' . $request->quantity . ' quantity of ' . $product->name . ' Successfully');
    }

    /**
     * Show the form for selling a new resource.
     *
     */
    public function saleView(Product $product)
    {
        return view('products.sale', ['product' => $product]);
    }

    /**
     * Purchase Product
     * @param ProductQuantityRequest $request
     * @param Product $product
     */
    public function sale(ProductQuantityRequest $request, Product $product)
    {
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();
        return redirect()->route('products.index')->with('Sold ' . $request->quantity . ' quantity of ' . $product->name . ' Successfully');
    }
}
