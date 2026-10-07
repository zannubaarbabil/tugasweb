@extends('layouts.admin')

@section('title', 'Edit Publisher')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Edit Publisher</h1>
                <p>Perbarui informasi publisher di BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.publishers.update', $publisher->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">
                        Nama Publisher
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $publisher->name) }}"
                    >
                </div>

                <div class="form-actions">
                    <a
                        href="{{ route('admin.publishers.index') }}"
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
