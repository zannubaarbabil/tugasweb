<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['author', 'category', 'publisher'])->get();

        return view('admin.books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.books.create', [
            'authors' => $authors,
            'categories' => $categories,
            'publishers' => $publishers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover' => 'required|image',
            'file' => 'required|mimes:pdf',
            'author_id' => 'required',
            'category_id' => 'required',
            'publisher_id' => 'required',
        ]);

        $coverPath = $request->file('cover')->store('covers', 'public');
        $filePath = $request->file('file')->store('books', 'public');
        $validated['cover'] = $coverPath;
        $validated['file'] = $filePath;

        Book::create($validated);

        return redirect()
            ->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.books.edit', compact(
            'book',
            'authors',
            'categories',
            'publishers'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover' => 'nullable|image',
            'file' => 'nullable|mimes:pdf',
            'author_id' => 'required',
            'category_id' => 'required',
            'publisher_id' => 'required',
        ]);

        if ($request->hasFile('cover')) {

            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $coverPath = $request->file('cover')->store('covers', 'public');
            $validated['cover'] = $coverPath;
        }

        if ($request->hasFile('file')) {

            if ($book->file && Storage::disk('public')->exists($book->file)) {
                Storage::disk('public')->delete($book->file);
            }

            $filePath = $request->file('file')->store('books', 'public');
            $validated['file'] = $filePath;
        }

        $book->update($validated);

        return redirect()
            ->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Hapus cover dari storage
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        // Hapus file PDF dari storage
        if ($book->file && Storage::disk('public')->exists($book->file)) {
            Storage::disk('public')->delete($book->file);
        }

        // Hapus data buku dari database
        $book->delete();

        return redirect()
            ->route('admin.books.index');
        }
}
