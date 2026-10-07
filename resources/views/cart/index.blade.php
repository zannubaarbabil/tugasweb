@extends('layouts.public')

@section('title', 'Keranjang - BookNest')

@section('content')

<section class="cart-section">
    {{-- HEADER --}}
    <div class="cart-header">
        <h1>🛒 Keranjang Belanja</h1>
        <p>Periksa kembali buku yang ingin kamu beli sebelum checkout.</p>
    </div>

    @if(count($cart) > 0)
        <div class="cart-layout">

            {{-- =========================
                DAFTAR BUKU
            ========================== --}}

            <div class="cart-items">
                @foreach($cart as $id => $item)
                    <article class="cart-item">
                        {{-- COVER --}}
                        <div class="cart-item-image">
                            <img
                                src="{{ asset('storage/' . $item['cover']) }}"
                                alt="{{ $item['title'] }}"
                            >
                        </div>

                        {{-- INFORMASI BUKU --}}
                        <div class="cart-item-info">
                            <h2>
                                {{ $item['title'] }}
                            </h2>
                            <p class="cart-item-price">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </p>

                            {{-- QUANTITY --}}
                            <form
                                action="{{ route('cart.update', $id) }}"
                                method="POST"
                                class="cart-update-form"
                            >
                                @csrf

                                <label for="quantity-{{ $id }}">
                                    Quantity
                                </label>

                                <div class="cart-quantity">
                                    <input
                                        id="quantity-{{ $id }}"
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                    >

                                    <button type="submit">
                                        Update
                                    </button>
                                </div>
                            </form>

                            {{-- SUBTOTAL --}}
                            <div class="cart-item-subtotal">
                                <span>Subtotal</span>

                                <strong>
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </strong>
                            </div>

                            {{-- HAPUS --}}
                            <form
                                action="{{ route('cart.remove', $id) }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="cart-remove-button"
                                >
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- =========================
                RINGKASAN PESANAN
            ========================== --}}

            <aside class="cart-summary">
                <h2>
                    Ringkasan Pesanan
                </h2>

                <div class="cart-summary-row">
                    <span>
                        Jumlah Buku
                    </span>

                    <strong>
                        {{ count($cart) }}
                    </strong>
                </div>

                <div class="cart-summary-divider"></div>

                <div class="cart-summary-total">
                    <span>
                        Total Belanja
                    </span>

                    <strong>
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </strong>
                </div>

                {{-- CHECKOUT --}}
                <form
                    action="{{ route('checkout') }}"
                    method="POST"
                    class="cart-checkout-form"
                >
                    @csrf

                    <button type="submit">
                        ✅ Checkout
                    </button>
                </form>

                <a
                    href="{{ route('books.index') }}"
                    class="cart-continue-button"
                >
                    ← Lanjut Belanja
                </a>
            </aside>
        </div>
    @else

        {{-- =========================
            KERANJANG KOSONG
        ========================== --}}

        <div class="cart-empty">
            <div class="cart-empty-icon">
                🛒
            </div>

            <h2>
                Keranjang kamu masih kosong 🥲
            </h2>

            <p>
                Yuk cari buku yang ingin kamu baca dan tambahkan ke keranjang.
            </p>

            <a href="{{ route('books.index') }}">
                Cari Buku
            </a>
        </div>
    @endif
</section>
@endsection
