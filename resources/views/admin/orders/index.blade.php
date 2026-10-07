@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

    <section class="admin-page">
        <div class="page-header">
            <div>
                <h1>📦 Pesanan Masuk</h1>
                <p>Kelola semua pesanan dari customer BookNest.</p>
            </div>
        </div>

        @if ($orders->count() > 0)
            <div class="admin-table-card">
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="table-number">
                                        #{{ $order->id }}
                                    </td>

                                    <td class="table-name-cell">
                                        {{ $order->user->name }}
                                    </td>

                                    <td class="order-total-price">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if ($order->status === 'pending')
                                            <span class="order-status-badge order-pending">
                                                Pending
                                            </span>
                                        @elseif ($order->status === 'processing')
                                            <span class="order-status-badge order-processing">
                                                Processing
                                            </span>
                                        @elseif ($order->status === 'completed')
                                            <span class="order-status-badge order-completed">
                                                Completed
                                            </span>
                                        @else
                                            <span class="order-status-badge">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>

                                    <td>
                                        <div class="table-actions">
                                            <a
                                                href="{{ route('admin.orders.show', $order->id) }}"
                                                class="action-button action-edit"
                                            >
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="admin-empty">
                <div class="admin-empty-icon">📦</div>
                <h3>Belum ada pesanan</h3>
                <p>Belum ada customer yang melakukan checkout.</p>
            </div>
        @endif
    </section>
@endsection
