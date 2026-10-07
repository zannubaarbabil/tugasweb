@extends('layouts.admin')

@section('title', 'Tambah Slider')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Tambah Slider</h1>
                <p>Tambahkan banner baru untuk halaman utama BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.sliders.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="form-group">
                    <label for="title">Judul Slider</label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Promo Buku Terbaru"
                        required
                    >

                    @error('title')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Gambar Slider</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        required
                    >

                    @error('image')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="1" selected>Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>

                    @error('status')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.sliders.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Slider</button>
                </div>
            </form>
        </div>
    </section>
@endsection
