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
        <div class="flex items-center gap-space-sm">
            <a href="{{ route('books.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-container hover:bg-primary text-white rounded-lg font-semibold text-sm shadow-sm transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>+ Tambah Buku</span>
            </a>
        </div>
    </div>

    <!-- Quick Analytics Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-space-md">
        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Total Judul</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $books->total() }} Judul</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-primary-container">
                <span class="material-symbols-outlined text-[22px]">auto_stories</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Kategori Aktif</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $categories->count() }} Klasifikasi</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-[22px]">category</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Total Di Halaman</p>
                <p class="text-xl font-bold text-on-surface mt-1">{{ $books->count() }} Ditampilkan</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[22px]">shelves</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-space-md rounded-xl shadow-xs border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-xs text-secondary uppercase tracking-wider font-semibold">Status Katalog</p>
                <p class="text-xl font-bold text-emerald-600 mt-1">Sinkron</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined text-[22px]">verified</span>
            </div>
        </div>
    </div>

    <!-- Toolbar & Filters -->
    <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-xs border border-outline-variant/30">
        <form method="GET" action="{{ route('books.index') }}" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
            <div class="flex flex-wrap items-center gap-space-sm flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:w-80">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput" 
                        class="w-full h-10 pl-10 pr-space-md bg-surface-container-low/50 rounded-lg text-sm text-on-surface placeholder:text-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200"
                        placeholder="Cari judul atau penulis…" 
                        value="{{ request('search') }}"
                    >
                </div>

                <!-- Category Filter -->
                <div class="relative min-w-[180px]">
                    <select 
                        name="category" 
                        id="categoryFilter" 
                        class="w-full h-10 pl-3 pr-10 bg-surface-container-low/50 rounded-lg text-sm text-on-surface appearance-none focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-container border border-slate-200 cursor-pointer"
                        onchange="this.form.submit()"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">expand_more</span>
                </div>

                <!-- Action Buttons -->
                <button type="submit" 
                        class="h-10 px-4 bg-primary-container hover:bg-primary text-white rounded-lg font-semibold text-sm transition-colors shadow-xs flex items-center gap-1.5 cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    <span>Cari</span>
                </button>

                @if(request('search') || request('category'))
                    <a href="{{ route('books.index') }}" 
                       class="h-10 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold text-sm transition-colors shadow-xs flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">refresh</span>
                        <span>Reset</span>
                    </a>
                @endif
            </div>

            <!-- Meta badge -->
            <div class="flex items-center gap-space-xs self-end lg:self-auto text-secondary text-xs">
                <span class="flex items-center gap-1 bg-surface-container-low px-2.5 py-1 rounded-md">
                    <span class="material-symbols-outlined text-[16px] text-tertiary-container">verified</span>
                    <span>Database Terhubung</span>
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
                                    <span class="inline-flex items-center px-3 py-1 rounded-full font-semibold bg-primary-fixed text-primary-container">
                                        {{ $book->category->name }}
                                    </span>
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
                    {{ $books->withQueryString()->links() }}
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
