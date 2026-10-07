@extends('layouts.customer')

@section('title', 'Dashboard Saya')

@section('content')

    <section class="customer-dashboard">
        <div class="customer-welcome">
            <h1>
                Halo, {{ auth()->user()->name }} 👋
            </h1>

            <p>
                Selamat datang di dashboard BookNest. Berikut ringkasan aktivitas belanjamu.
            </p>
        </div>

        {{-- STATISTIK CUSTOMER --}}
        <div class="customer-stats">
            <div class="customer-stat-card">
                <span class="stat-icon">📦</span>

                <div>
                    <p>Total Pesanan</p>
                    <h2>{{ $totalOrders }}</h2>
                </div>
            </div>

            <div class="customer-stat-card">
                <span class="stat-icon">⏳</span>

                <div>
                    <p>Pesanan Pending</p>
                    <h2>{{ $pendingOrders }}</h2>
                </div>
            </div>

            <div class="customer-stat-card">
                <span class="stat-icon">💰</span>

                <div>
                    <p>Total Belanja</p>
                    <h2>
                        Rp {{ number_format($totalSpent, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>


        {{-- PESANAN TERBARU --}}
        <div class="recent-orders">
            <div class="section-header">
                <div>
                    <h2>Pesanan Terbaru</h2>
                    <p>Lihat pesanan terbaru yang telah kamu buat.</p>
                </div>
            </div>

            @if ($orders->count() > 0)
                <div class="orders-list">
                    @foreach ($orders->take(5) as $order)
                        <div class="order-card">
                            <div class="order-info">
                                <h3>
                                    Order #{{ $order->id }}
                                </h3>

                                <p>
                                    {{ $order->created_at->format('d M Y') }}
                                </p>
                            </div>

                            <div class="order-status">
                                <span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="order-total">
                                <p>Total</p>

                                <strong>
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-orders">
                    <h3>Belum ada pesanan 📚</h3>
                    <p>
                        Kamu belum melakukan pembelian buku.
                    </p>

                    <a href="{{ route('books.index') }}">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
