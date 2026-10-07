@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Sliders</h1>
                <p>Kelola banner yang tampil di halaman utama BookNest.</p>
            </div>

            <a
                href="{{ route('admin.sliders.create') }}"
                class="btn btn-primary"
            >
                + Tambah Slider
            </a>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr>
                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <img
                                        src="{{ asset('storage/' . $slider->image) }}"
                                        alt="{{ $slider->title }}"
                                        class="slider-thumbnail"
                                    >
                                </td>

                                <td class="table-name-cell">
                                    {{ $slider->title }}
                                </td>

                                <td>
                                    @if ($slider->status)
                                        <span class="status-badge status-active">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="status-badge status-inactive">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="{{ route('admin.sliders.edit', $slider->id) }}"
                                            class="action-button action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus slider ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-button action-delete"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="5"
                                    class="empty-table"
                                >
                                    Belum ada slider.

                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
