<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use App\Models\Master;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
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

		$types = Type::latest()->paginate(10);

        return view('types.index', compact('types'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
        $type = new Type;
        $type->product_id = $request->product_id;
        $type->type_id = $request->type_id;
        $type->table_type = $master->table_type;
        $type->master_id = $master->id;
        $type->related_product_id = $request->related_product_id;
        $type->order = $request->order;
        $type->save();
        return redirect('/types?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $product = Product::find($type->product_id);
        $table_type = Master::find($type->table_type);
        $master = Master::find($type->master_id);
        return view('types.show', compact('product', 'type','table_type','master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {

        $products = Product::where('status', 1)->get();

        return view('types.edit', compact('type', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'table_type'  => 'required',
            'master_id'  => 'required',
        ]);
        $type->table_type = $request->table_type;
        $type->master_id = $request->master_id;
        $type->product_id = $request->product_id;
        $type->update();
        return redirect('/types?productId=' . $request->product_id.'&type_id='.$request->type_id)->with('success', 'Type created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect('/types?productId=' . $type->product_id)->with('success', 'Type deleted successfully');
    }
}
