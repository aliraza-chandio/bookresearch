<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Type;
use Illuminate\Http\Request;
use Datatables;

class MasterController extends Controller
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
    public function index()
    {
        $masters = Master::orderBy('id', 'ASC')->get();

        if(request()->ajax()) {
            return datatables()->of(Master::orderBy('id', 'ASC')->get())
            ->addColumn('action', 'book-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('masters.index', compact('masters'));
        // ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.create');
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
            'type_id' => 'required',
            'table_type' => 'required',
            'parent' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $master = Master::create([
            'type_id' => $request->type_id,
            'table_type' => $request->table_type,
            'parent' => $request->parent,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'desc' => $request->desc,
            'extra' => $request->extra,
            'order_number' => $request->order,
        ]);
        return redirect()->route('masters.index')
            ->with('success', 'Master created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        $type = Type::find($master->type_id);
        $parent = Master::find($master->parent);
        $table_type = Master::find($master->table_type);
        return view('masters.show', compact('master', 'type', 'parent', 'table_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $master)
    {
        return view('masters.edit', compact('master'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $master->update($request->all());

        return redirect()->route('masters.index')
            ->with('success', 'Master updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        $master->delete();

        return redirect()->route('masters.index')
            ->with('success', 'Master deleted successfully');
    }
}
