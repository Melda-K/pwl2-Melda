<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class BookController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        return view('books.index', $data);
    }

    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        return view('books.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'public/cover_buku', 
                'cover_buku_'.time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        Book::create($validated);

        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if($request->save == true) {
            return redirect()->route('books')->with($notification);
        } else {
            return redirect()->route('book.create')->with($notification);
        }
    }

    public function print_books()
    {
        $books = Book::all();

        $pdf = PDF::loadview('books.print', ['books' => $books]); 
        return $pdf->download('data_buku.pdf'); 
    }
}