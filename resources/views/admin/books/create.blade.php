@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Tambah Buku</h1>
                <p>Tambahkan buku baru ke koleksi BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.books.store') }}"
                method="POST"
                class="book-form"
                enctype="multipart/form-data"
            >
                @csrf

                {{-- @if ($errors->any())
                    <div class="form-error-box">
                        <strong>Ups! Ada beberapa data yang belum benar:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="form-group">
                    <label for="title">
                        Judul Buku
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                    >
                </div>

                <div class="form-group">
                    <label for="description">
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                    ></textarea>
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
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="author_id">
                        Author
                    </label>

                    <select
                        id="author_id"
                        name="author_id"
                    >

                        <option value="">
                            -- Pilih Author --
                        </option>

                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                    >

                        <option value="">
                            -- Pilih Category --
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="publisher_id">
                        Publisher
                    </label>

                    <select
                        id="publisher_id"
                        name="publisher_id"
                    >

                        <option value="">
                            -- Pilih Publisher --
                        </option>

                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}">
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cover">
                        Cover Buku
                    </label>

                    <input
                        type="file"
                        id="cover"
                        name="cover"
                    >

                </div>

                <div class="form-group">
                    <label for="file">
                        File Buku
                    </label>

                    <input
                        type="file"
                        id="file"
                        name="file"
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
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
