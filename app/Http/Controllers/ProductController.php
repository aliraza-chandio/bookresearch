<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        /*$products = Product::orderBy('id', 'DESC')->paginate(10);
		
        if ($request->ajax()) {

            $products = Product::orderBy('id', 'ASC')->get();
            return datatables()->of($products)
                ->addColumn('type', function ($row) {
                    $type = Type::find($row->type_id);
                    return $type->name;
                })->addColumn('other', function ($row) {
                    $html = '<a href="/product_natives?productId='.$row->id.'"class="btn btn-primary btn-sm" target="_blank">Native</a>   <a href="/product_masters?productId='.$row->id.'&type_id='.$row->type_id.'"class="btn btn-success btn-sm" target="_blank">Master</a><a href="/product_relateds?productId='.$row->id.'&type_id='.$row->type_id.'"class="btn btn-danger btn-sm" target="_blank">Releated</a>';
                    return $html;
                })->addColumn('featured', function ($row) {
                    return $row->featured == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                })->addColumn('status', function ($row) {
                    $html = $row->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>';
                    return $html;
                })->addColumn('action', function ($row) {
                    $html = '<a class="btn-sm btn btn-info" href="'.route('products.show', $row->id).'"><i class="fa fa-eye"></i></a><a class="btn-sm btn btn-primary" href="'.route('products.edit', $row->id).'"><i class="fa fa-edit"></i></a> <button type="submit" class="btn-sm btn btn-danger" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                    return $html;
                })->rawColumns(['other','featured','status','action'])
                ->toJson();
        }
        return view('products.index');
        // ->with('i', (request()->input('page', 1) - 1) * 10);
		*/

        $data = $request->all();
        $types = Type::where('app_status', '1')->get();
        $query = Product::query();
        // dd($data['ProductSearch']['type_id']);
        if (isset($data['ProductSearch']['type_id']) && !empty($data['ProductSearch']['type_id'])) {
            $query->where('type_id', $data['ProductSearch']['type_id']);
        }
        if (isset($data['ProductSearch']['id']) && !empty($data['ProductSearch']['id'])) {
            $query->where('id', $data['ProductSearch']['id']);
        }
        if (isset($data['ProductSearch']['name']) && !empty($data['ProductSearch']['name'])) {
            $query->whereRaw('name LIKE "%'.$data['ProductSearch']['name'].'%"');
        }
        if (isset($data['ProductSearch']['slug']) && !empty($data['ProductSearch']['slug'])) {
            $query->where('slug', $data['ProductSearch']['slug']);
        }
        if (isset($data['ProductSearch']['date_birthday']) && !empty($data['ProductSearch']['date_birthday'])) {
            $query->where('date_birthday', $data['ProductSearch']['date_birthday']);
        }
        if (isset($data['ProductSearch']['date_death']) && !empty($data['ProductSearch']['date_death'])) {
            $query->where('date_death', $data['ProductSearch']['date_death']);
        }
        if (isset($data['ProductSearch']['featured']) && !empty($data['ProductSearch']['featured'])) {
            $query->where('featured', $data['ProductSearch']['featured']);
        }
        if (isset($data['ProductSearch']['status']) && !empty($data['ProductSearch']['status'])) {
            $query->where('status', $data['ProductSearch']['status']);
        }
        if (isset($data['ProductSearch']['most_view']) && !empty($data['ProductSearch']['most_view'])) {
            $query->where('most_view', $data['ProductSearch']['most_view']);
        }


        $products = $query->orderBy('id', 'DESC')->paginate(10);


        return view('products.index',compact('products','types'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required',
            'slug' => 'required',
            'keywords' => 'required',
            'date_birthday' => 'required',
            'date_death' => 'required',
            'image_visible' => 'required',
            'featured' => 'required',
            'api_featured' => 'required',
            'featured' => 'required',
        ]);

        $product = Product::create([
            'type_id' => $request->type_id,
            'extra' => $request->extra,
            'name' => $request->name,
            'slug' => $request->slug,
            'desc' => $request->desc,
            'keywords' => $request->keywords,
            'date_birthday' => $request->date_birthday,
            'date_death' => $request->date_death,
            'date_birthday_g' => $request->date_birthday_g,
            'date_death_g' => $request->date_death_g,
            'image_visible' => $request->image_visible,
            'featured' => $request->featured,
            'api_featured' => $request->api_featured,
            'featured' => $request->featured,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $type = Type::find($product->type_id);
        $parent = Product::find($product->parent);
        $table_type = Product::find($product->table_type);
        return view('products.show', compact('product', 'type', 'parent', 'table_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'type_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'keywords' => 'required',
            'date_birthday' => 'required',
            'date_death' => 'required',
        ]);
        $product = Product::find($request->product_id);
        $product->type_id = $request->type_id;
        $product->extra = $request->extra;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->desc = $request->desc;
        $product->keywords = $request->keywords;
        $product->date_birthday = $request->date_birthday;
        $product->date_death = $request->date_death;
        $product->date_birthday_g = $request->date_birthday_g;
        $product->date_death_g = $request->date_death_g;
        $product->image_visible = $request->image_visible;
        $product->featured = $request->featured;
        $product->api_featured = $request->api_featured;
        $product->status = $request->status;
        // dd($product->featured);
        $product->update();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function getScholars()
    {
        return view('products.share-scholars');
    }
}
