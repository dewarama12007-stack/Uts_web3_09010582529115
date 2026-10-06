<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalStock = Book::sum('stock');
        $recentBooks = Book::with('category')->latest()->take(5)->get();
        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalStock',
            'recentBooks',
            'categories'
        ));
    }
}
