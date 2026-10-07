<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $orders = $user->orders()
            ->latest()
            ->get();

        $totalOrders = $orders->count();

        $pendingOrders = $orders
            ->where('status', 'pending')
            ->count();

        $totalSpent = $orders->sum('total_price');

        return view('customer.dashboard', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'totalSpent'
        ));
    }

    public function orders()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->get();

        return view('customer.orders', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = auth()->user()
            ->orders()
            ->with('items.book')
            ->findOrFail($id);

        return view('customer.order-detail', compact('order'));
    }

    public function receipt($id)
    {
        $order = auth()->user()
            ->orders()
            ->with('items.book')
            ->findOrFail($id);

        if ($order->status !== 'paid') {
            abort(403);
        }

        return view('customer.receipt', compact('order'));
    }
}
