<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMaster;
use App\Models\Master;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductMasterController extends Controller
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
        if (isset($request->productId) && $request->productId <> 0 ) {
            $product_masters = ProductMaster::where('product_id', $request->productId)->orderBy('id', 'DESC')->paginate(10);
            $productId = $request->productId;
            $typeId = $request->type_id;
        } else {
            $product_masters = ProductMaster::orderBy('id', 'DESC')->paginate(10);
            $productId = 0;
            $typeId = 0;
        }
        // dd($product_masters);
        return view('product_master.index', compact('product_masters', 'productId', 'typeId'))
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
        $typeId = $request->type_id;
        // if (isset($productId)) {
        //     $products = Product::where('id', $productId)->get();
        // } else {
        //     $productId = '';
        //     $products = Product::where('status', 1)->get();
        // }
        // dd($products);
        return view('product_master.create', compact('productId','typeId'));
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
            'table_type'  => 'required',
            'master_id'  => 'required',
        ]);
        $product_master = new ProductMaster;
        $product_master->table_type = $request->table_type;
        $product_master->master_id = $request->master_id;
        $product_master->product_id = $request->product_id;
        $product_master->save();
        return redirect('/product_masters?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'ProductMaster created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductMaster  $product_master
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMaster $product_master)
    {
        $product = Product::find($product_master->product_id);
        $table_type = Master::find($product_master->table_type);
        $master = Master::find($product_master->master_id);
        return view('product_master.show', compact('product', 'product_master','table_type','master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductMaster  $product_master
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMaster $product_master)
    {

        $products = Product::where('status', 1)->get();

        return view('product_master.edit', compact('product_master', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductMaster  $product_master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductMaster $product_master)
    {
        $request->validate([
            'table_type'  => 'required',
            'master_id'  => 'required',
        ]);
        $product_master->table_type = $request->table_type;
        $product_master->master_id = $request->master_id;
        $product_master->product_id = $request->product_id;
        $product_master->update();
        return redirect('/product_masters?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'ProductMaster created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductMaster  $product_master
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMaster $product_master)
    {
        $product_master->delete();

        return redirect('/product_masters?productId=' . $product_master->product_id)->with('success', 'ProductMaster deleted successfully');
    }
}
