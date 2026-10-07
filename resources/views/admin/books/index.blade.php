@extends('layouts.admin')

@section('title', 'Books')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>Daftar Buku</h1>
                <p>Kelola semua buku yang tersedia di BookNest.</p>
            </div>

            <a
                href="{{ route('admin.books.create') }}"
                class="btn btn-primary"
            >
                + Tambah Buku
            </a>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Publisher</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td class="table-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="book-title-cell">
                                    {{ $book->title }}
                                </td>

                                <td>
                                    {{ $book->author->name }}
                                </td>

                                <td>
                                    {{ $book->category->name }}
                                </td>

                                <td>
                                    {{ $book->publisher->name }}
                                </td>

                                <td class="book-price-cell">
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $book->stock }}
                                </td>

                                <td>

                                    <div class="table-actions">
                                        <a
                                            href="{{ route('admin.books.edit', $book->id) }}"
                                            class="action-button action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.books.destroy', $book->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
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
