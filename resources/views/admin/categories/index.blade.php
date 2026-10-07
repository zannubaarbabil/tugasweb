@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Daftar Category</h1>
                <p>Kelola semua category buku di BookNest.</p>
            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="btn btn-primary"
            >
                + Tambah Category
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
                            <th>Nama Category</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="author-name-cell">
                                    {{ $category->name }}
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="action-button action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus category ini?');"
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
