@extends('layouts.public')

@section('title', 'Daftar Buku')

@section('content')

    <section class="books-section">
        <h1>Daftar Buku</h1>
        <p class="books-description">Temukan berbagai buku yang tersedia di BookNest.</p>
        <form action="{{ route('books.index') }}" method="GET" class="book-search">
            <input
                type="text"
                name="search"
                placeholder="Cari judul atau penulis..."
                value="{{ request('search') }}"
            >

            <button type="submit">
                🔍 Cari
            </button>
        </form>

        <div class="book-grid">
            @if ($books->count() > 0)
                @foreach ($books as $book)
                    <article class="book-card">
                        <div class="book-cover">
                            <img
                                src="{{ asset('storage/' . $book->cover) }}"
                                alt="Cover {{ $book->title }}"
                            >
                        </div>

                        <div class="book-info">
                            <h3>{{ $book->title }}</h3>
                            <p class="book-author">
                                {{ $book->author->name }}
                            </p>
                            <p class="book-price">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </p>

                            <a
                                href="{{ route('book.show', $book->id) }}"
                                class="book-detail-button"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </article>
                @endforeach
            @else
                <p class="book-not-found">
                    😔 Buku yang kamu cari tidak ditemukan.
                </p>
            @endif
        </div>
    </section>
@endsection
