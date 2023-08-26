<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Type;
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
		$types = Type::latest()->get();

        return view('books.create', compact('types'));
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
            'title'  => 'required',
            'description'  => 'required',
            'status'  => 'required',
        ]);

        $book = new Book;
        $book->type_id = $request->type_id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->extra = "";
        $book->save();
        return redirect('/books')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $type = Type::find($book->type_id);
        return view('books.show', compact('book','type'));
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
