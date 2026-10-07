@extends('layouts.customer')

@section('title', 'Pesanan Saya')

@section('content')

    <section class="customer-orders">
        <div class="customer-page-header">
            <h1>📦 Pesanan Saya</h1>

            <p>
                Berikut adalah semua pesanan yang telah kamu lakukan.
            </p>
        </div>

        @if ($orders->count() > 0)
            <div class="customer-orders-list">
                @foreach ($orders as $order)
                    <div class="customer-order-card">
                        <div class="customer-order-info">
                            <h3>
                                Order #{{ $order->id }}
                            </h3>

                            <p>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <div class="customer-order-status">
                            <span>
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="customer-order-total">
                            <p>Total Belanja</p>

                            <strong>
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div class="customer-order-action">
                            <a href="{{ route('customer.orders.show', $order->id)}}">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-orders">
                <h3>Belum ada pesanan 📚</h3>

                <p>
                    Kamu belum melakukan pembelian apa pun.
                </p>

                <a href="{{ route('books.index') }}">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </section>
@endsection
