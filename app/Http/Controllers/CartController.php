<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Kalau stok habis
        if ($book->stock <= 0) {
            return redirect()->back()
                ->with('error', 'Maaf, buku ini sedang habis.');
        }

        $cart = session()->get('cart', []);

        // Kalau buku sudah ada di keranjang
        if (isset($cart[$id])) {

            // Cek apakah quantity sudah mencapai stok
            if ($cart[$id]['quantity'] >= $book->stock) {
                return redirect()->back()
                    ->with('error', 'Quantity sudah mencapai batas stok yang tersedia.');
            }

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                'title' => $book->title,
                'price' => $book->price,
                'quantity' => 1,
                'cover' => $book->cover,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $book->stock,
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }
}

