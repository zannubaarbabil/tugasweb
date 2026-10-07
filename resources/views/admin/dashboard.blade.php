@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    <section class="admin-dashboard">
        <div class="dashboard-header">
            <div>
                <h2>Dashboard</h2>
                <p>
                    Selamat datang kembali di Admin BookNest.
                    Kelola data toko buku kamu dari sini.
                </p>
            </div>
        </div>

        <div class="dashboard-stats">
            <a href="{{ route('admin.books.index') }}" class="dashboard-card">
                <div class="dashboard-card-icon">
                    📚
                </div>
                <div class="dashboard-card-info">
                    <p>Total Buku</p>
                    <h3>{{ $bookCount }}</h3>
                </div>
            </a>

            <a href="{{ route('admin.authors.index') }}" class="dashboard-card">
                <div class="dashboard-card-icon">
                    ✍️
                </div>
                <div class="dashboard-card-info">
                    <p>Total Author</p>
                    <h3>{{ $authorCount }}</h3>
                </div>
            </a>

            <a href="{{ route('admin.categories.index')}}" class="dashboard-card">
                <div class="dashboard-card-icon">
                    🏷️
                </div>
                <div class="dashboard-card-info">
                    <p>Total Category</p>
                    <h3>{{ $categoryCount }}</h3>
                </div>
            </a>

            <a href="{{ route('admin.publishers.index')}}" class="dashboard-card">
                <div class="dashboard-card-icon">
                    🏢
                </div>
                <div class="dashboard-card-info">
                    <p>Total Publisher</p>
                    <h3>{{ $publisherCount }}</h3>
                </div>
            </a>
        </div>
    </section>
@endsection
