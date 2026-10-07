@extends('layouts.public')

@section('title', 'Categories - BookNest')

@section('content')

    <section class="categories-page">
        <h1>Book Categories 📚</h1>
        <p>Explore books based on your favorite categories.</p>
        <div class="categories-grid">
            @forelse ($categories as $category)
                <a
                    href="{{ route('categories.show', $category->id) }}"
                    class="category-card"
                >
                    <h2>{{ $category->name }}</h2>
                    <p>{{ $category->books_count }} Books</p>
                </a>
            @empty
                <p>No categories available yet.</p>
            @endforelse
        </div>
    </section>
@endsection
