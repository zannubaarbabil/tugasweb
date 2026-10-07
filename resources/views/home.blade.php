@extends('layouts.public')

@section('title', 'Home')

@section('content')

    <section class="home-hero">
        <div class="home-hero-content">
            <span class="hero-badge">
                📚 Toko Buku Online
            </span>

            <h1>
                Temukan Cerita <br>
                <span>Favoritmu</span>
            </h1>

            <p>
                Jelajahi berbagai buku pilihan, temukan bacaan
                yang menemani perjalananmu, dan dapatkan koleksi
                terbaik hanya di BookNest.
            </p>

            <a
                href="{{ route('books.index') }}"
                class="hero-button"
            >
                Jelajahi Koleksi →
            </a>
        </div>
    </section>

    @if ($sliders->count() > 0)
        <section class="slider-section">
            <div class="slider-container">
                <div class="slider-track">
                    @foreach ($sliders as $slider)
                        <div class="slider-item">
                            <img
                                src="{{ asset('storage/' . $slider->image) }}"
                                alt="{{ $slider->title }}"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="slider-btn slider-prev">
                ❮
            </button>

            <button class="slider-btn slider-next">
                ❯
            </button>

            <div class="slider-dots">
                @foreach ($sliders as $index => $slider)
                    <button
                        class="slider-dot {{ $index === 0 ? 'active' : '' }}"
                        data-slide="{{ $index }}"
                    ></button>
                @endforeach
            </div>
        </section>
        @endif

    <section class="books-section">
        <h2>Buku Terbaru</h2>
        <p class="books-description">
            Temukan koleksi buku terbaru yang bisa menemani waktu membaca kamu.
        </p>
        <div class="book-grid">
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
        </div>
    </section>

@endsection
