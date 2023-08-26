<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRelated;
use App\Models\Master;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductRelatedController extends Controller
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
        $data = $request->all();
        
		if(!$data['ProductSearch']['product_id']){
			return redirect()->back()->with('error','Product Id Not found');
		}
        		
		$query = ProductRelated::query();
        
        if (isset($data['ProductSearch']['id']) && !empty($data['ProductSearch']['id'])) {
            $query->where('id', $data['ProductSearch']['id']);
        }
        if (isset($data['ProductSearch']['type_id']) && !empty($data['ProductSearch']['type_id'])) {
			$query->where('type_id', $data['ProductSearch']['type_id']);
        }
        if (isset($data['ProductSearch']['related_product_id']) && !empty($data['ProductSearch']['related_product_id'])) {
			$query->where('related_product_id', $data['ProductSearch']['related_product_id']);
        }
        if (isset($data['ProductSearch']['master_id']) && !empty($data['ProductSearch']['master_id'])) {
            $query->where('master_id', $data['ProductSearch']['master_id']);
        }
        if (isset($data['ProductSearch']['order']) && !empty($data['ProductSearch']['order'])) {
			$query->where('order', $data['ProductSearch']['order']);
        }
		$query->where('product_id', $data['ProductSearch']['product_id']);
        $product_relateds = $query->orderBy('id', 'DESC')->paginate(10);
        
        
        
        // if (isset($request->productId) && $request->productId <> 0 ) {
        $masterIds = ProductRelated::where('product_id', $data['ProductSearch']['product_id'])->groupBy('master_id')->pluck('master_id');
		$masters = Master::whereIn('id',$masterIds)->get();
        $typeIds = ProductRelated::where('product_id', $data['ProductSearch']['product_id'])->groupBy('type_id')->pluck('type_id');
		$types = Type::whereIn('id',$typeIds)->get();
		
		$related_productIds = ProductRelated::where('product_id', $data['ProductSearch']['product_id'])->groupBy('related_product_id')->pluck('related_product_id');
		$related_products = Product::whereIn('id',$related_productIds)->get();
        return view('product_related.index', compact('product_relateds','masters','types','related_products'))
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
        $types = Type::All();
        return view('product_related.create', compact('productId','typeId','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_id'  => 'required',
            'related_product_id'  => 'required',
            'order'  => 'required',
        ]);
        $master = Master::find($request->master_id);
        if(!$master){
            return redirect()->back()->with('error', 'Master Could not Found.');
        }
        $product_related = new ProductRelated;
        $product_related->product_id = $request->product_id;
        $product_related->type_id = $request->type_id;
        $product_related->table_type = $master->table_type;
        $product_related->master_id = $master->id;
        $product_related->related_product_id = $request->related_product_id;
        $product_related->order = $request->order;
        $product_related->save();
        return redirect('/product_relateds?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'ProductRelated created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductRelated  $product_related
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRelated $product_related)
    {
        $product = Product::find($product_related->product_id);
        $table_type = Master::find($product_related->table_type);
        $master = Master::find($product_related->master_id);
        return view('product_related.show', compact('product', 'product_related','table_type','master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductRelated  $product_related
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRelated $product_related)
    {

        $products = Product::where('status', 1)->get();

        return view('product_related.edit', compact('product_related', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductRelated  $product_related
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRelated $product_related)
    {
        $request->validate([
            'table_type'  => 'required',
            'master_id'  => 'required',
        ]);
        $product_related->table_type = $request->table_type;
        $product_related->master_id = $request->master_id;
        $product_related->product_id = $request->product_id;
        $product_related->update();
        return redirect('/product_relateds?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'ProductRelated created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductRelated  $product_related
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRelated $product_related)
    {
        $product_related->delete();

        return redirect('/product_relateds?productId=' . $product_related->product_id)->with('success', 'ProductRelated deleted successfully');
    }
}
