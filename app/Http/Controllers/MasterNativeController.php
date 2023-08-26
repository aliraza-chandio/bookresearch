<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\MasterNative;
use App\Models\Type;
use Illuminate\Http\Request;

class MasterNativeController extends Controller
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
        if (isset($request->masterId)) {
            $master_natives = MasterNative::where('master_id', $request->masterId)->orderBy('id', 'DESC')->paginate(10);
            $masterId = $request->masterId;
        } else {
            $master_natives = MasterNative::orderBy('id', 'DESC')->paginate(10);
            $masterId = 0;
        }

        return view('master_native.index', compact('master_natives', 'masterId'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $masterId = $request->masterId;
        // if (isset($masterId)) {
        //     $masters = Master::where('id', $masterId)->get();
        // } else {
        //     $masterId = '';
        //     $masters = Master::where('status', 1)->get();
        // }
        // dd($masters);
        return view('master_native.create', compact('masterId'));
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
            'name' => 'required',
            'desc' => 'required',
            'lang' => 'required',
            'status' => 'required',
        ]);
        // dd($request->all());
        $master_native = MasterNative::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'keywords' => $request->keywords,
            'lang' => $request->lang,
            'status' => $request->status,
            'master_id' => $request->master_id,
        ]);
        return redirect('/master_natives?masterId=' . $request->master_id)->with('success', 'MasterNative created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterNative  $master_native
     * @return \Illuminate\Http\Response
     */
    public function show(MasterNative $master_native)
    {
        $master = Master::find($master_native->master_id);
        return view('master_native.show', compact('master','master_native'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterNative  $master_native
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterNative $master_native)
    {

        $masters = Master::where('status', 1)->get();
        return view('master_native.edit', compact('master_native','masters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterNative  $master_native
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterNative $master_native)
    {

        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'lang' => 'required',
            'status' => 'required',
        ]);
        $master_native->name = $request->name;
        $master_native->desc = $request->desc;
        $master_native->keywords = $request->keywords;
        $master_native->lang = $request->lang;
        $master_native->status = $request->status;
        // $master_native->master_id = 3;
        // dd($master_native);
        $master_native->update();
        return redirect('/master_natives?masterId=' . $master_native->master_id)->with('success', 'MasterNative updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterNative  $master_native
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterNative $master_native)
    {
        $master_native->delete();

        return redirect()->route('master_natives.index')
            ->with('success', 'MasterNative deleted successfully');
    }
}
