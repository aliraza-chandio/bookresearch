<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductNative;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductNativeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->productId) && $request->productId <> 0) {
            $product_natives = ProductNative::where('product_id', $request->productId)->orderBy('id', 'DESC')->paginate(10);
            $productId = $request->productId;
        } else {
            $product_natives = ProductNative::orderBy('id', 'DESC')->paginate(10);
            $productId = 0;
        }
        // dd($product_natives);
        return view('product_native.index', compact('product_natives', 'productId'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $productId = $request->productId;
        if($productId != 0){
            $product = Product::find($request->productId);
            $productTitle = $product->name;
        }
        else{
            $productTitle = '';
        }
        // if (isset($productId)) {
        //     $products = Product::where('id', $productId)->get();
        // } else {
        //     $productId = '';
        //     $products = Product::where('status', 1)->get();
        // }
        // dd($products);
        return view('product_native.create', compact('productId','productTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'lang'  => 'required',
            'name'  => 'required',
            'status'  => 'required',
            'image_visible'  => 'required',
        ]);
        $product_native = new ProductNative;
        $product_native->lang = $request->lang;
        $product_native->url = $request->url;
        $product_native->name = $request->name;
        $product_native->status = $request->status;
        $product_native->image_visible = $request->image_visible;
        $product_native->desc = $request->meta_description;
        $product_native->title = $request->title;
        $product_native->meta_description = $request->meta_description;
        $product_native->keywords = $request->keywords;
        $product_native->product_id = $request->product_id;
        $product_native->save();
        return redirect('/product_natives?productId=' . $request->product_id)->with('success', 'ProductNative created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductNative  $product_native
     * @return \Illuminate\Http\Response
     */
    public function show(ProductNative $product_native)
    {
        $product = Product::find($product_native->product_id);
        return view('product_native.show', compact('product', 'product_native'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductNative  $product_native
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,ProductNative $product_native)
    {

        $productId = $request->productId;
        if($productId != 0){
            $product = Product::find($request->productId);
            $productTitle = $product->name;
        }
        else{
            $productTitle = '';
        }
        $products = Product::where('status', 1)->get();
        return view('product_native.edit', compact('product_native', 'products', 'productTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductNative  $product_native
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductNative $product_native)
    {
        $request->validate([
            'lang'  => 'required',
            'name'  => 'required',
            'status'  => 'required',
            'image_visible'  => 'required',
        ]);
        $product_native->lang = $request->lang;
        $product_native->url = $request->url;
        $product_native->name = $request->name;
        $product_native->status = $request->status;
        $product_native->image_visible = $request->image_visible;
        $product_native->desc = $request->desc;
        $product_native->title = $request->title;
        $product_native->meta_description = $request->meta_desc;
        $product_native->keywords = $request->keywords;
        $product_native->update();
        return redirect('/product_natives?productId=' . $product_native->product_id)->with('success', 'Product Native updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductNative  $product_native
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductNative $product_native)
    {
        $product_native->delete();

        return redirect('/product_natives?productId=' . $product_native->product_id)->with('success', 'ProductNative deleted successfully');
    }
}
