<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books')); // Pastikan 'books.index' benar
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
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|digits:4',
            'isbn' => 'nullable|string|max:17|unique:books',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->publication_year;
        $book->isbn = $request->isbn;
        $book->description = $request->description;

        if ($request->hasFile('cover_image')) {
            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->storeAs('covers', $imageName, 'public');
            $book->cover_image = 'covers/'.$imageName;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|digits:4',
            'isbn' => 'nullable|string|max:17|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->publication_year;
        $book->isbn = $request->isbn;
        $book->description = $request->description;

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }
            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->storeAs('public/covers', $imageName);
            $book->cover_image = 'covers/'.$imageName;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::delete('public/' . $book->cover_image);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}