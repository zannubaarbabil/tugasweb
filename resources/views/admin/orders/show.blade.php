@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')

    <section class="admin-page">

        <div class="page-header">

            <div>

                <h1>📦 Detail Pesanan #{{ $order->id }}</h1>

                <p>
                    Informasi lengkap pesanan customer BookNest.
                </p>

            </div>


            <a
                href="{{ route('admin.orders.index') }}"
                class="btn-cancel"
            >
                ← Kembali
            </a>

        </div>


        {{-- INFORMASI CUSTOMER --}}
        <div class="order-customer-card">

            <h2>👤 Informasi Customer</h2>


            <div class="order-customer-info">

                <div class="order-info-item">

                    <span>Nama Customer</span>

                    <strong>
                        {{ $order->user->name }}
                    </strong>

                </div>


                <div class="order-info-item">

                    <span>Email</span>

                    <strong>
                        {{ $order->user->email }}
                    </strong>

                </div>


                <div class="order-info-item">

                    <span>Tanggal Pesanan</span>

                    <strong>
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- BUKU YANG DIBELI --}}
        <div class="order-items-card">

            <h2>📚 Buku yang Dibeli</h2>


            <div class="admin-table-wrapper">

                <table class="admin-table">

                    <thead>

                        <tr>

                            <th>Buku</th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($order->items as $item)

                            <tr>

                                <td class="table-name-cell">

                                    {{ $item->book->title }}

                                </td>


                                <td>

                                    Rp {{ number_format($item->price, 0, ',', '.') }}

                                </td>


                                <td>

                                    {{ $item->quantity }}

                                </td>


                                <td class="order-subtotal">

                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- TOTAL DAN STATUS --}}
        <div class="order-summary-grid">


            {{-- TOTAL PESANAN --}}
            <div class="order-summary-card">

                <div class="order-summary-icon">
                    💰
                </div>

                <div>

                    <p>Total Pesanan</p>

                    <h2>
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h2>

                </div>

            </div>


            {{-- STATUS PEMBAYARAN --}}
            <div class="order-status-card">

                <h2>💳 Status Pembayaran</h2>

                <p class="order-current-status">

                    Status saat ini:

                    <strong>
                        @if ($order->status === 'pending')
                            🟡 Menunggu Pembayaran
                        @elseif ($order->status === 'paid')
                            🟢 Pembayaran Berhasil
                        @else
                            {{ ucfirst($order->status) }}
                        @endif
                    </strong>

                </p>

                <form
                    action="{{ route('admin.orders.update', $order->id) }}"
                    method="POST"
                    class="order-status-form"
                >

                    @csrf
                    @method('PUT')

                    <select name="status">

                        <option
                            value="pending"
                            @selected($order->status === 'pending')
                        >
                            Menunggu Pembayaran
                        </option>

                        <option
                            value="paid"
                            @selected($order->status === 'paid')
                        >
                            Pembayaran Berhasil
                        </option>

                    </select>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Pembayaran
                    </button>

                </form>

            </div>
        </div>

    </section>

@endsection
