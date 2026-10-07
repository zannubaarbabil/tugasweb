<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class  PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Publisher::create($validated);

        return redirect()
            ->route('admin.publishers.index')
            ->with('succes', 'Publisher berhasil ditambahkan.');
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
        $publisher = Publisher::findOrFail($id);
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $publisher = Publisher::findOrFail($id);
        $publisher->update($validated);

        return redirect()
            ->route('admin.publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::findOrFail($id);
        if ($publisher->books()->exists()) {
            return redirect()
                ->route('admin.publishers.index')
                ->with('error', 'Publisher tidak dapat dihapus karena masih digunakan oleh buku.');
        }

        $publisher->delete();

        return redirect()
            ->route('admin.publishers.index')
            ->with('success', 'Publisher berhasil dihapus.');
    }
}
