@extends('layouts.admin')

@section('title', 'Tambah Category')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Tambah Category</h1>
                <p>Tambahkan category baru untuk buku di BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.categories.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-group">
                    <label for="name">
                        Nama Category
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                    >
                </div>

                <div class="form-actions">
                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Category
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
