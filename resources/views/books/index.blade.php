@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="flex flex-col w-full gap-space-lg">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
        <div>
            <h1 class="font-headline-lg text-2xl sm:text-3xl font-bold text-on-surface tracking-tight">Daftar Buku</h1>
            <p class="font-body-sm text-sm text-secondary mt-1">Kelola katalog inventaris, kategori pustaka, dan ketersediaan stok fisik.</p>
        </div>
        <div class="flex items-center gap-space-sm flex-wrap">
            <a href="{{ route('books.export') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-surface-container-lowest hover:bg-surface-container-low text-emerald-700 border border-emerald-200 rounded-lg font-semibold text-sm shadow-xs transition-colors"
               title="Unduh format spreadsheet CSV">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Unduh CSV</span>
            </a>
            <a href="{{ route('books.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-container hover:bg-primary text-white rounded-lg font-semibold text-sm shadow-sm transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>+ Tambah Buku</span>
            </a>
        </div>
    </div>

    <!-- Quick Analytics Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-space-md">
        <!-- Total Judul -->
        <a href="{{ route('books.index') }}" 
           class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between hover:border-primary-container/40 transition-colors group">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold group-hover:text-primary-container transition-colors">Total Judul</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $totalTitles }} Judul</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container group-hover:bg-primary-container group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-[22px]">auto_stories</span>
            </div>
        </a>

        <!-- Total Eksemplar -->
        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Total Eksemplar</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $totalStock }} Buku</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-[22px]">shelves</span>
            </div>
        </div>

        <!-- Stok Menipis -->
        <a href="{{ route('books.index', ['stock_status' => 'low_stock']) }}" 
           class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between hover:border-amber-400 transition-colors group">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold group-hover:text-amber-700 transition-colors">Stok Menipis (≤5)</p>
                <p class="text-xl font-bold text-amber-600 mt-1">{{ $lowStockCount }} Judul</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-[22px]">warning</span>
            </div>
        </a>

        <!-- Kategori Aktif -->
        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Kategori Aktif</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $totalCategories }} Klasifikasi</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[22px]">category</span>
            </div>
        </div>
    </div>

    <!-- Toolbar & Filters -->
    <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-xs border border-outline-variant/30">
        <form method="GET" action="{{ route('books.index') }}" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
            <div class="flex flex-wrap items-center gap-space-sm flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput" 
                        class="w-full h-10 pl-10 pr-space-md bg-surface-container-low/50 rounded-lg text-sm text-on-surface placeholder:text-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200"
                        placeholder="Cari judul, penulis, penerbit…" 
                        value="{{ request('search') }}"
                    >
                </div>

                <!-- Category Filter -->
                <div class="relative min-w-[160px]">
                    <select 
                        name="category" 
                        id="categoryFilter" 
                        class="w-full h-10 pl-3 pr-9 bg-surface-container-low/50 rounded-lg text-sm text-on-surface appearance-none focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200 cursor-pointer"
                        onchange="this.form.submit()"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">expand_more</span>
                </div>

                <!-- Stock Status Filter -->
                <div class="relative min-w-[150px]">
                    <select 
                        name="stock_status" 
                        class="w-full h-10 pl-3 pr-9 bg-surface-container-low/50 rounded-lg text-sm text-on-surface appearance-none focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200 cursor-pointer"
                        onchange="this.form.submit()"
                    >
                        <option value="">Status Stok</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Stok Aman (&gt;5)</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Stok Menipis (≤5)</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Stok Habis (0)</option>
                    </select>
                    <span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">expand_more</span>
                </div>

                <!-- Sort Dropdown -->
                <div class="relative min-w-[150px]">
                    <select 
                        name="sort" 
                        class="w-full h-10 pl-3 pr-9 bg-surface-container-low/50 rounded-lg text-sm text-on-surface appearance-none focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200 cursor-pointer"
                        onchange="this.form.submit()"
                    >
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Urutan: Terkini</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Urutan: Terlama</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Judul (A - Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Judul (Z - A)</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stok Terbanyak</option>
                        <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Tahun Terbaru</option>
                    </select>
                    <span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">sort</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="h-10 px-4 bg-primary-container hover:bg-primary text-white rounded-lg font-semibold text-sm transition-colors shadow-xs flex items-center gap-1.5 cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    <span>Filter</span>
                </button>

                @if(request('search') || request('category') || request('stock_status') || request('sort'))
                    <a href="{{ route('books.index') }}" 
                       class="h-10 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold text-sm transition-colors shadow-xs flex items-center gap-1.5"
                       title="Bersihkan semua filter">
                        <span class="material-symbols-outlined text-[18px]">refresh</span>
                        <span>Reset</span>
                    </a>
                @endif
            </div>

            <!-- Meta badge -->
            <div class="flex items-center gap-space-xs self-end lg:self-auto text-secondary text-xs">
                <span class="flex items-center gap-1 bg-surface-container-low px-2.5 py-1 rounded-md font-mono text-[11px]">
                    <span class="material-symbols-outlined text-[14px] text-emerald-600">dns</span>
                    <span>{{ $books->total() }} Data Ditemukan</span>
                </span>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 overflow-hidden flex flex-col">
        @if($books->count() > 0)
            <div class="w-full overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-secondary text-xs uppercase tracking-wider font-semibold">
                            <th class="py-3.5 px-6" style="width: 50px;">No</th>
                            <th class="py-3.5 px-6" scope="col">Judul Buku</th>
                            <th class="py-3.5 px-6" scope="col">Penulis</th>
                            <th class="py-3.5 px-6" scope="col">Penerbit & Tahun</th>
                            <th class="py-3.5 px-6" scope="col">Kategori</th>
                            <th class="py-3.5 px-6 text-center" scope="col">Stok</th>
                            <th class="py-3.5 px-6 text-center" style="width: 170px;" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @foreach($books as $index => $book)
                            <tr class="hover:bg-surface-container-low/60 transition-colors group">
                                <td class="py-4 px-6 text-xs text-secondary font-medium">
                                    {{ $books->firstItem() + $index }}
                                </td>
                                <td class="py-4 px-6 text-on-surface">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-11 bg-primary-fixed/60 rounded flex items-center justify-center text-primary-container flex-shrink-0 shadow-xs">
                                            <span class="material-symbols-outlined text-[20px]">book_2</span>
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('books.show', $book) }}" 
                                               class="font-semibold text-sm text-on-surface block group-hover:text-primary-container transition-colors truncate">
                                                {{ $book->title }}
                                            </a>
                                            <span class="font-mono text-xs text-secondary">ID #{{ $book->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-on-surface-variant font-medium">
                                    {{ $book->author }}
                                </td>
                                <td class="py-4 px-6 text-xs text-secondary">
                                    <div>{{ $book->publisher }}</div>
                                    <span class="inline-block mt-0.5 font-mono px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px]">
                                        {{ $book->year }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-xs">
                                    <a href="{{ route('books.index', ['category' => $book->category_id]) }}" 
                                       class="inline-flex items-center px-3 py-1 rounded-full font-semibold bg-primary-fixed text-primary-container hover:bg-primary-container hover:text-white transition-colors"
                                       title="Filter kategori ini">
                                        {{ $book->category->name }}
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($book->stock > 5)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ $book->stock }} pcs
                                        </span>
                                    @elseif($book->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            {{ $book->stock }} pcs
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center gap-1.5">
                                        <!-- Detail Button -->
                                        <a href="{{ route('books.show', $book) }}" 
                                           class="w-8 h-8 rounded-lg flex items-center justify-center text-primary-container bg-surface-container-low hover:bg-primary-container hover:text-white transition-colors" 
                                           title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('books.edit', $book) }}" 
                                           class="w-8 h-8 rounded-lg flex items-center justify-center text-amber-700 bg-amber-50 hover:bg-amber-500 hover:text-white transition-colors border border-amber-200" 
                                           title="Edit Buku">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('books.destroy', $book) }}" 
                                              method="POST" 
                                              class="m-0"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $book->title }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-600 bg-red-50 hover:bg-red-600 hover:text-white transition-colors border border-red-200 cursor-pointer" 
                                                    title="Hapus Buku">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 bg-surface-container-low/40 border-t border-outline-variant/20 gap-3">
                <div class="text-xs text-secondary">
                    Menampilkan <strong>{{ $books->firstItem() ?? 0 }}</strong> sampai <strong>{{ $books->lastItem() ?? 0 }}</strong> dari <strong>{{ $books->total() }}</strong> buku
                </div>
                <div>
                    {{ $books->links() }}
                </div>
            </div>
        @else
            <!-- Empty State Illustration -->
            <div class="w-full py-16 px-space-md flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 mb-space-md rounded-full bg-surface-container flex items-center justify-center shadow-xs text-primary-container">
                    <span class="material-symbols-outlined text-4xl">search_off</span>
                </div>
                <h2 class="font-headline-md text-lg font-bold text-on-surface tracking-tight">Buku tidak ditemukan</h2>
                <p class="font-body-md text-sm text-secondary max-w-sm mt-1 mb-space-md">
                    Coba sesuaikan kata kunci pencarian atau ubah filter kategori pilihan Anda.
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('books.index') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-surface-container-low hover:bg-surface-container text-primary-container rounded-lg font-semibold text-sm transition-colors border border-outline-variant/40">
                        <span class="material-symbols-outlined text-[18px]">refresh</span>
                        <span>Reset Pencarian</span>
                    </a>
                    <a href="{{ route('books.create') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-white rounded-lg font-semibold text-sm transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        <span>+ Tambah Buku</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
