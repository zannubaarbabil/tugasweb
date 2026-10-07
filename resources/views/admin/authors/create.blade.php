@extends('layouts.admin')

@section('title', 'Tambah Author')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Tambah Author</h1>
                <p>Tambahkan author baru ke BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.authors.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-group">
                    <label for="name">
                        Nama Author
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
                        href="{{ route('admin.authors.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Author
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
