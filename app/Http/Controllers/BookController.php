<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search by title, author, or publisher
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('publisher', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            $status = $request->input('stock_status');
            if ($status === 'in_stock') {
                $query->where('stock', '>', 5);
            } elseif ($status === 'low_stock') {
                $query->where('stock', '>', 0)->where('stock', '<=', 5);
            } elseif ($status === 'out_of_stock') {
                $query->where('stock', 0);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'stock_desc':
                $query->orderBy('stock', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $books = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        // Real-time analytics metrics for highlights
        $totalTitles = Book::count();
        $totalStock = (int) Book::sum('stock');
        $lowStockCount = Book::where('stock', '<=', 5)->count();
        $totalCategories = Category::count();

        return view('books.index', compact(
            'books', 
            'categories', 
            'totalTitles', 
            'totalStock', 
            'lowStockCount', 
            'totalCategories'
        ));
    }

    /**
     * Export all books to CSV.
     */
    public function exportCsv()
    {
        $books = Book::with('category')->orderBy('title')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="katalog-buku-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($books) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM so Microsoft Excel opens special characters cleanly
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, ['No', 'ID', 'Judul Buku', 'Penulis', 'Penerbit', 'Tahun', 'Kategori', 'Stok Fisik', 'Tanggal Ditambahkan']);

            foreach ($books as $index => $book) {
                fputcsv($file, [
                    $index + 1,
                    $book->id,
                    $book->title,
                    $book->author,
                    $book->publisher,
                    $book->year,
                    $book->category ? $book->category->name : '-',
                    $book->stock,
                    $book->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }

    /**
     * Validate book request data with custom Indonesian error messages.
     */
    private function validateBook(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Judul buku wajib diisi.',
            'title.max' => 'Judul buku maksimal 255 karakter.',
            'author.required' => 'Nama penulis wajib diisi.',
            'author.max' => 'Nama penulis maksimal 255 karakter.',
            'publisher.required' => 'Nama penerbit wajib diisi.',
            'publisher.max' => 'Nama penerbit maksimal 255 karakter.',
            'year.required' => 'Tahun terbit wajib diisi.',
            'year.integer' => 'Tahun terbit harus berupa angka.',
            'year.min' => 'Tahun terbit minimal tahun 1900.',
            'year.max' => 'Tahun terbit tidak boleh melebihi tahun depan.',
            'stock.required' => 'Jumlah stok fisik wajib diisi.',
            'stock.integer' => 'Jumlah stok harus berupa bilangan bulat.',
            'stock.min' => 'Jumlah stok minimal 0.',
            'category_id.required' => 'Silakan pilih kategori buku.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid dalam database.',
        ]);
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $validated = $this->validateBook($request);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $this->validateBook($request);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
