@extends('layouts.admin')

@section('title', 'Tambah Publisher')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Tambah Publisher</h1>
                <p>Tambahkan publisher baru ke BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.publishers.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-group">
                    <label for="name">
                        Nama Publisher
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
                        href="{{ route('admin.publishers.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Publisher
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
