<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk Order #{{ $order->id }} - BookNest</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="receipt-body">
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>BookNest</h1>
            <p>ONLINE BOOKSTORE</p>
        </div>

        <div class="receipt-title">
            <h2>STRUK PEMBELIAN</h2>
        </div>

        <div class="receipt-info">
            <div>
                <span>Order</span>
                <strong>#{{ $order->id }}</strong>
            </div>

            <div>
                <span>Pelanggan</span>
                <strong>{{ $order->user->name }}</strong>
            </div>

            <div>
                <span>Tanggal</span>
                <strong>
                    {{ $order->created_at->format('d M Y, H:i') }}
                </strong>
            </div>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-items">
            @foreach ($order->items as $item)
                <div class="receipt-item">
                    <div class="receipt-item-name">
                        <strong>{{ $item->book->title }}</strong>

                        <span>
                            {{ $item->quantity }} ×
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <strong>
                        Rp {{ number_format(
                            $item->price * $item->quantity,
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>
                </div>
            @endforeach
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-total">
            <span>TOTAL</span>

            <strong>
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </strong>
        </div>

        <div class="receipt-payment">
            <div>
                <span>Pembayaran</span>
                <strong>TUNAI</strong>
            </div>

            <div>
                <span>Status</span>
                <strong>🟢 LUNAS</strong>
            </div>
        </div>

        <div class="receipt-thanks">
            <p>Terima kasih telah berbelanja di BookNest 🙏</p>
            <strong>BOOKNEST</strong>
        </div>

        <div class="receipt-actions">
            <button onclick="window.print()">
                🖨 Cetak Struk
            </button>

            <a href="{{ route('customer.orders.show', $order->id) }}">
                ← Kembali ke Detail Pesanan
            </a>
        </div>
    </div>
</body>
</html>
