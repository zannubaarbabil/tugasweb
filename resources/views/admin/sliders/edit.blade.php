@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Edit Slider</h1>
                <p>Perbarui informasi slider BookNest.</p>
            </div>
        </div>

        <div class="admin-form-card">
            <form
                action="{{ route('admin.sliders.update', $slider->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Judul Slider</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $slider->title) }}"
                        required
                    >

                    @error('title')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Gambar saat ini --}}
                <div class="form-group">
                    <label>Gambar Saat Ini</label>

                    <img
                        src="{{ asset('storage/' . $slider->image) }}"
                        alt="{{ $slider->title }}"
                        class="slider-current-image"
                    >
                </div>

                {{-- Ganti gambar --}}
                <div class="form-group">
                    <label for="image">Ganti Gambar</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                    >

                    <small class="form-hint">Kosongkan jika tidak ingin mengganti gambar.</small>
                    @error('image')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="1" @selected(old('status', $slider->status) == 1)>Aktif</option>
                        <option value="0" @selected(old('status', $slider->status) == 0)>Nonaktif</option>
                    </select>

                    @error('status')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.sliders.index') }}" class="btn-cancel">Batal</a>

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
