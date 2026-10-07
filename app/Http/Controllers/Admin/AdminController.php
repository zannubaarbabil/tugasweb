<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

class AdminController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $authorCount = Author::count();
        $categoryCount = Category::count();
        $publisherCount = Publisher::count();

        return view('admin.dashboard', [
            'bookCount' => $bookCount,
            'authorCount' => $authorCount,
            'categoryCount' => $categoryCount,
            'publisherCount' => $publisherCount,
        ]);
    }
}
