@extends('layouts.public')

@section('title', $category->name . ' - BookNest')

@section('content')

    <section class="category-detail-page">
        <a
            href="{{ route('categories.index') }}"
            class="category-back-button"
        >
            ← Semua Categories
        </a>

        <div class="category-detail-header">
            <h1>
                {{ $category->name }} 📚
            </h1>

            <p>
                Temukan koleksi buku dalam kategori
                {{ $category->name }}.
            </p>
        </div>

        @if ($category->books->count() > 0)
            <div class="book-grid">
                @foreach ($category->books as $book)
                    <article class="book-card">
                        <div class="book-cover">
                            @if ($book->cover)
                                <img
                                    src="{{ asset('storage/' . $book->cover) }}"
                                    alt="Cover {{ $book->title }}"
                                >
                            @endif
                        </div>

                        <div class="book-info">
                            <h3>
                                {{ $book->title }}
                            </h3>

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
            </div>
        @else
            <div class="category-empty">
                <h3>
                    📚 Belum ada buku
                </h3>

                <p>
                    Belum ada buku yang tersedia dalam kategori
                    {{ $category->name }}.
                </p>
            </div>
        @endif
    </section>
@endsection
