@extends('layouts.admin')

@section('title', 'Edit Author')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Edit Author</h1>
                <p>Perbarui informasi author di BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.authors.update', $author->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">
                        Nama Author
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $author->name) }}"
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
