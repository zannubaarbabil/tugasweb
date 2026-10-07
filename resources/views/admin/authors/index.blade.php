@extends('layouts.admin')

@section('title', 'Authors')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Daftar Author</h1>
                <p>Kelola semua author yang tersedia di BookNest.</p>

            </div>

            <a
                href="{{ route('admin.authors.create') }}"
                class="btn btn-primary"
            >
                + Tambah Author
            </a>
        </div>

        {{-- Pesan Error --}}
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pesan Success --}}
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
                            <th>Nama Author</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="table-name-cell">
                                    {{ $author->name }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="{{ route('admin.authors.edit', $author->id) }}"
                                            class="action-button action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.authors.destroy', $author->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus author ini?');"
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
