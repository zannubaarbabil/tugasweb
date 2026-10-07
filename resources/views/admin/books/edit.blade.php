@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Edit Buku</h1>
                <p>Perbarui informasi buku yang tersedia di BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.books.update', $book->id) }}"
                method="POST"
                class="book-form"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">
                        Judul Buku
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $book->title) }}"
                    >
                </div>

                <div class="form-group">
                    <label for="description">
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                    >{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">
                            Harga
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $book->price) }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="stock">
                            Stok
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', $book->stock) }}"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="author_id">
                        Author
                    </label>

                    <select id="author_id" name="author_id">

                        <option value="">
                            -- Pilih Author --
                        </option>

                        @foreach ($authors as $author)

                            <option
                                value="{{ $author->id }}"
                                @selected(old('author_id', $book->author_id) == $author->id)
                            >
                                {{ $author->name }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">
                        Category
                    </label>

                    <select id="category_id" name="category_id">
                        <option value="">
                            -- Pilih Category --
                        </option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(old('category_id', $book->category_id) == $category->id)
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="publisher_id">
                        Publisher
                    </label>

                    <select id="publisher_id" name="publisher_id">

                        <option value="">
                            -- Pilih Publisher --
                        </option>

                        @foreach ($publishers as $publisher)
                            <option
                                value="{{ $publisher->id }}"
                                @selected(old('publisher_id', $book->publisher_id) == $publisher->id)
                            >
                                {{ $publisher->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Cover Saat Ini
                    </label>

                    <div class="current-cover">
                        <img
                            src="{{ asset('storage/' . $book->cover) }}"
                            alt="Cover {{ $book->title }}"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="cover">
                        Ganti Cover Buku
                        <span class="optional-text">(Opsional)</span>
                    </label>

                    <input
                        type="file"
                        id="cover"
                        name="cover"
                    >
                </div>

                <div class="form-actions">
                    <a
                        href="{{ route('admin.books.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
