@extends('layouts.public')

@section('title', $book->title)

@section('content')

    <section class="book-detail">
        <div class="book-detail-cover">
            <img
                src="{{ asset('storage/' . $book->cover) }}"
                alt="Cover {{ $book->title }}"
            >
        </div>

        <div class="book-detail-info">
            <h1>{{ $book->title }}</h1>
            <p class="book-detail-author">
                {{ $book->author->name }}
            </p>

            <div class="book-detail-meta">
                <p>
                    <strong>Kategori:</strong>
                    {{ $book->category->name }}
                </p>

                <p>
                    <strong>Publisher:</strong>
                    {{ $book->publisher->name }}
                </p>
            </div>

            <div class="book-detail-price">
                Rp {{ number_format($book->price, 0, ',', '.') }}
            </div>

            <p class="book-detail-stock">
                Stok tersedia: {{ $book->stock }}
            </p>

            <div class="book-detail-description">
                <h2>Deskripsi</h2>
                <p>
                    {{ $book->description }}
                </p>
            </div>

            @if ($book->stock > 0)
                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="book-cart-button">
                        🛒 Tambah ke Keranjang
                    </button>
                </form>
            @else
                <button class="book-cart-button" disabled>
                    Sold Out
                </button>
            @endif
        </div>
    </section>
@endsection
