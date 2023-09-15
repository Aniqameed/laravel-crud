<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use  App\Models\products;

class ProductController extends Controller
{
    public function index (){
        $products = Products::all();
        return view('products.index', ['products' => $products]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $newProduct = products::create($data);

        return redirect(route('product.index'));

    }

    public function edit(Products $product){
        return view('products.edit', ['product' => $product]);
    }

    public function update(Products $product, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product Updated Succesffully');

    }

    public function destroy(Products $product){
        $product->delete();
        return redirect(route('product.index'))->with('success', 'Product deleted Succesffully');
    }
}
