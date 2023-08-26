<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Book;
use App\Models\Master;
use Illuminate\Http\Request;

class BookController extends Controller
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

		$books = Book::latest()->paginate(10);

        return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
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
            'book_id'  => 'required',
            'related_product_id'  => 'required',
            'order'  => 'required',
        ]);
        $master = Master::find($request->master_id);
        if(!$master){
            return redirect()->back()->with('error', 'Master Could not Found.');
        }
        $book = new Book;
        $book->product_id = $request->product_id;
        $book->book_id = $request->book_id;
        $book->table_book = $master->table_book;
        $book->master_id = $master->id;
        $book->related_product_id = $request->related_product_id;
        $book->order = $request->order;
        $book->save();
        return redirect('/books?productId=' . $request->product_id.'&book_id='.$request->book_id)->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $product = Product::find($book->product_id);
        $table_book = Master::find($book->table_book);
        $master = Master::find($book->master_id);
        return view('books.show', compact('product', 'book','table_book','master'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

        $products = Product::where('status', 1)->get();

        return view('books.edit', compact('book', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'table_book'  => 'required',
            'master_id'  => 'required',
        ]);
        $book->table_book = $request->table_book;
        $book->master_id = $request->master_id;
        $book->product_id = $request->product_id;
        $book->update();
        return redirect('/books?productId=' . $request->product_id.'&book_id='.$request->book_id)->with('success', 'Book created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books?productId=' . $book->product_id)->with('success', 'Book deleted successfully');
    }
}
