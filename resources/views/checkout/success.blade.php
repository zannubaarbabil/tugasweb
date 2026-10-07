@extends('layouts.customer')

@section('title', 'Checkout Berhasil')

@section('content')

<section class="checkout-success">
    <div class="success-icon">
        ✓
    </div>

    <h1>Pesanan Berhasil Dibuat! 🎉</h1>

    <p class="success-message">
        Terima kasih sudah melakukan pemesanan di BookNest.
        Pesananmu sudah berhasil dicatat.
    </p>

    <div class="payment-notice">
        <h2>💵 Pembayaran Tunai di Toko</h2>

        <p>
            Silakan selesaikan pembayaran Anda di toko BookNest
            dengan membawa nomor pesanan berikut:
        </p>

        <div class="order-number">
            Order #{{ $order->id }}
        </div>

        <p class="payment-status">
            Status pembayaran:
            <strong>
                @if ($order->status === 'pending')
                    🟡 Menunggu Pembayaran
                @elseif ($order->status === 'paid')
                    🟢 Pembayaran Berhasil
                @endif
            </strong>
        </p>
    </div>

    <div class="success-summary">

        <div>
            <span>Total Pesanan</span>
            <strong>
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </strong>
        </div>

        <div>
            <span>Tanggal Pesanan</span>
            <strong>
                {{ $order->created_at->format('d M Y, H:i') }}
            </strong>
        </div>

    </div>

    <div class="success-actions">
        <a href="{{ route('customer.orders.show', $order->id) }}" class="success-primary-button">
            Lihat Detail Pesanan
        </a>

        <a href="{{ route('books.index') }}" class="success-secondary-button">
            Belanja Buku Lagi
        </a>
    </div>

</section>

@endsection
