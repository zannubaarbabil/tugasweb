@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')

    <section class="order-detail-page">
        <div class="customer-page-header">
            <h1>📦 Detail Pesanan #{{ $order->id }}</h1>

            <p>
                Detail lengkap pesanan yang telah kamu lakukan.
            </p>
        </div>

        {{-- INFORMASI PESANAN --}}
        <div class="order-detail-info">
            <div>
                <p>Status Pembayaran</p>

                <strong>
                    @if ($order->status === 'pending')
                        🟡 Menunggu Pembayaran
                    @elseif ($order->status === 'paid')
                        🟢 Pembayaran Berhasil
                    @endif
                </strong>
            </div>

            <div>
                <p>Tanggal Pesanan</p>

                <strong>
                    {{ $order->created_at->format('d M Y, H:i') }}
                </strong>
            </div>
        </div>


        {{-- DAFTAR BUKU --}}
        <div class="order-items-section">
            <h2>Buku yang Dibeli</h2>

            @foreach ($order->items as $item)
                <div class="order-item-card">
                    <div class="order-item-book">
                        <h3>
                            {{ $item->book->title }}
                        </h3>

                        <p>
                            Harga: Rp {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="order-item-quantity">
                        <p>Quantity</p>

                        <strong>
                            {{ $item->quantity }}
                        </strong>
                    </div>

                    <div class="order-item-subtotal">
                        <p>Subtotal</p>

                        <strong>
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- TOTAL --}}
        <div class="order-final-total">
            <span>Total Pesanan</span>

            <strong>
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </strong>
        </div>

        <div class="order-detail-action">
            <a href="{{ route('customer.orders') }}">
                ← Kembali ke Pesanan Saya
            </a>

            @if ($order->status === 'paid')
                <a href="{{ route('customer.orders.receipt', $order->id) }}" class="order-receipt-button">
                    🧾 Lihat Struk
                </a>
            @endif
        </div>
    </section>
@endsection
