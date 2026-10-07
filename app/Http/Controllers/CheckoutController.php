<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Cek apakah keranjang kosong
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $order = DB::transaction(function () use ($cart) {

            $total = 0;

            // Hitung total ulang dan cek stok
            foreach ($cart as $bookId => $item) {

                $book = Book::findOrFail($bookId);

                if ($item['quantity'] > $book->stock) {
                    throw new \Exception(
                        'Stok buku ' . $book->title . ' tidak mencukupi.'
                    );
                }

                $total += $book->price * $item['quantity'];
            }

            // Buat Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // Buat Order Items dan kurangi stok
            foreach ($cart as $bookId => $item) {

                $book = Book::findOrFail($bookId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'quantity' => $item['quantity'],
                    'price' => $book->price,
                ]);

                $book->decrement(
                    'stock',
                    $item['quantity']
                );
            }

            return $order;
        });

        // Kosongkan keranjang setelah checkout berhasil
        session()->forget('cart');

        // Arahkan customer ke halaman checkout berhasil
        return redirect()->route(
            'checkout.success',
            $order->id
        );
    }

    public function success($id)
    {
        $order = Auth::user()
            ->orders()
            ->findOrFail($id);

        return view('checkout.success', compact('order'));
    }
}
