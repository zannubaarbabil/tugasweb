<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)
            ->latest()
            ->get();
        $books = Book::with(['author', 'category', 'publisher'])
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('sliders', 
        'books'));
    }
}
