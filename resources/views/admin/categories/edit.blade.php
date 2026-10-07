@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Edit Category</h1>
                <p>Perbarui informasi category di BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.categories.update', $category->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">
                        Nama Category
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
