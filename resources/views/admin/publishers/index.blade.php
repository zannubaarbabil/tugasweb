@extends('layouts.admin')

@section('title', 'Publishers')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Daftar Publisher</h1>
                <p>Kelola semua publisher yang tersedia di BookNest.</p>
            </div>

            <a
                href="{{ route('admin.publishers.create') }}"
                class="btn btn-primary"
            >
                + Tambah Publisher
            </a>
        </div>

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="admin-table-card">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Publisher</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($publishers as $publisher)
                            <tr>
                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="table-name-cell">
                                    {{ $publisher->name }}
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="{{ route('admin.publishers.edit', $publisher->id) }}"
                                            class="action-button action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.publishers.destroy', $publisher->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus publisher ini?');"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
