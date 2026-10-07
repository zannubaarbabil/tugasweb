<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index( Request $request)
    {
        $search = $request->search;

        $books = Book::with('author')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->get();

        return view('books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $book = Book::with(['author', 'category', 'publisher'])
            ->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
