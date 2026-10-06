@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col w-full gap-space-xl">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-space-md">
        <div>
            <div class="flex items-center gap-space-xs mb-1">
                <span class="font-code-sm text-xs text-primary uppercase tracking-wider font-semibold">Ikhtisar Katalog</span>
            </div>
            <h1 class="font-headline-xl text-3xl font-bold text-on-surface tracking-tight">Dashboard</h1>
            <p class="font-body-md text-sm text-secondary mt-0.5">
                Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Pantau ketersediaan koleksi dan pergerakan pustaka hari ini.
            </p>
        </div>
        <div class="flex items-center gap-space-sm flex-wrap">
            <a href="{{ route('books.export') }}" 
               class="bg-surface-container-lowest hover:bg-surface-container-low text-emerald-700 font-label-md text-sm px-4 py-2.5 rounded-lg shadow-xs flex items-center gap-1.5 transition-colors border border-emerald-200">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Unduh Laporan CSV</span>
            </a>
            <a href="{{ route('books.index') }}" 
               class="bg-surface-container-lowest hover:bg-surface-container-low text-on-surface-variant font-label-md text-sm px-4 py-2.5 rounded-lg shadow-xs flex items-center gap-1.5 transition-colors border border-outline-variant/30">
                <span class="material-symbols-outlined text-[18px]">menu_book</span>
                <span>Katalog Buku</span>
            </a>
            <a href="{{ route('books.create') }}" 
               class="bg-primary-container hover:bg-primary text-white font-label-md text-sm px-4 py-2.5 rounded-lg shadow-sm flex items-center gap-1.5 transition-colors">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>+ Tambah Buku</span>
            </a>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
        <!-- Total Buku -->
        <div class="bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 p-space-lg flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <span class="font-label-sm text-xs uppercase tracking-wider text-secondary font-semibold">Total Judul Buku</span>
                    <span class="font-headline-xl text-[36px] font-bold text-on-surface mt-1 tracking-tight leading-none">{{ $totalBooks }}</span>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary-container shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                </div>
            </div>
            <div class="mt-space-lg pt-space-sm flex items-center justify-between border-t border-outline-variant/20">
                <span class="font-body-sm text-xs text-secondary">Judul terdaftar aktif</span>
                <span class="inline-flex items-center text-xs font-semibold text-tertiary-container bg-surface-container-high px-2 py-0.5 rounded-full">
                    <span class="material-symbols-outlined text-[14px] mr-0.5">trending_up</span> Koleksi Aktif
                </span>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 p-space-lg flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <span class="font-label-sm text-xs uppercase tracking-wider text-secondary font-semibold">Total Kategori</span>
                    <span class="font-headline-xl text-[36px] font-bold text-on-surface mt-1 tracking-tight leading-none">{{ $totalCategories }}</span>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-tertiary shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">folder_special</span>
                </div>
            </div>
            <div class="mt-space-lg pt-space-sm flex items-center justify-between border-t border-outline-variant/20">
                <span class="font-body-sm text-xs text-secondary truncate max-w-[180px]">
                    {{ $categories->pluck('name')->join(', ') }}
                </span>
                <span class="inline-flex items-center text-xs font-semibold text-white bg-on-surface px-2 py-0.5 rounded-full">
                    Klasifikasi
                </span>
            </div>
        </div>

        <!-- Total Stok Fisik -->
        <div class="bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 p-space-lg flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <span class="font-label-sm text-xs uppercase tracking-wider text-secondary font-semibold">Total Stok Fisik</span>
                    <span class="font-headline-xl text-[36px] font-bold text-on-surface mt-1 tracking-tight leading-none">{{ $totalStock }}</span>
                </div>
                <div class="w-12 h-12 rounded-full bg-surface-container-high flex items-center justify-center text-on-primary-fixed-variant shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">layers</span>
                </div>
            </div>
            <div class="mt-space-lg pt-space-sm flex items-center justify-between border-t border-outline-variant/20">
                <span class="font-body-sm text-xs text-secondary">{{ $totalStock }} eksemplar tersedia di rak</span>
                <span class="inline-flex items-center text-xs font-semibold text-on-secondary-container bg-surface-container-low px-2 py-0.5 rounded-full">
                    Siap Pinjam
                </span>
            </div>
        </div>
    </div>

    <!-- Main Section: Recent Books & Category Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-space-lg">
        <!-- Recent Books Table (Span 3) -->
        <div class="lg:col-span-3 bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 overflow-hidden flex flex-col">
            <div class="px-space-xl py-space-lg bg-surface-container-lowest border-b border-outline-variant/20 flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-lg font-bold text-on-surface">Buku Terbaru</h2>
                    <p class="font-body-sm text-xs text-secondary mt-0.5">Inventaris judul mutakhir yang baru saja ditambahkan</p>
                </div>
                <a href="{{ route('books.index') }}" 
                   class="font-label-md text-sm text-primary-container hover:text-primary font-semibold flex items-center gap-1 transition-colors">
                    <span>Lihat Semua</span>
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </a>
            </div>

            <div class="w-full overflow-x-auto">
                @if($recentBooks->count() > 0)
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-secondary text-xs uppercase tracking-wider font-semibold">
                                <th class="py-3.5 px-space-xl" scope="col">Judul Buku</th>
                                <th class="py-3.5 px-space-lg" scope="col">Penulis</th>
                                <th class="py-3.5 px-space-lg" scope="col">Kategori</th>
                                <th class="py-3.5 px-space-xl text-right" scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low">
                            @foreach($recentBooks as $book)
                                <tr class="hover:bg-surface-container-low/70 transition-colors group">
                                    <td class="py-4 px-space-xl text-on-surface">
                                        <div class="flex items-center gap-space-md">
                                            <div class="w-9 h-11 bg-primary-fixed/60 rounded flex items-center justify-center text-primary-container flex-shrink-0 shadow-xs">
                                                <span class="material-symbols-outlined text-[20px]">book_2</span>
                                            </div>
                                            <div class="min-w-0">
                                                <a href="{{ route('books.show', $book) }}" 
                                                   class="font-semibold text-on-surface block group-hover:text-primary-container transition-colors truncate">
                                                    {{ $book->title }}
                                                </a>
                                                <span class="font-code-sm text-xs text-secondary">{{ $book->publisher }} ({{ $book->year }})</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-space-lg text-sm text-on-surface-variant font-medium">
                                        {{ $book->author }}
                                    </td>
                                    <td class="py-4 px-space-lg text-xs">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full font-semibold bg-primary-fixed text-primary-container">
                                            {{ $book->category->name }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-space-xl text-right">
                                        @if($book->stock > 5)
                                            <span class="inline-flex items-center justify-end text-xs font-bold text-emerald-700 px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-200">
                                                {{ $book->stock }} pcs
                                            </span>
                                        @elseif($book->stock > 0)
                                            <span class="inline-flex items-center justify-end text-xs font-bold text-amber-700 px-2.5 py-1 rounded-md bg-amber-50 border border-amber-200">
                                                {{ $book->stock }} pcs
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-end text-xs font-bold text-red-700 px-2.5 py-1 rounded-md bg-red-50 border border-red-200">
                                                Habis
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-12 text-center text-secondary">
                        <span class="material-symbols-outlined text-4xl text-outline mb-2">auto_stories</span>
                        <p class="font-medium text-sm">Belum ada buku terdaftar.</p>
                        <a href="{{ route('books.create') }}" class="mt-3 inline-flex items-center gap-1 text-sm text-primary-container font-semibold">
                            + Tambah buku sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Categories Breakdown Card (Span 1) -->
        <div class="lg:col-span-1 bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 p-space-lg flex flex-col">
            <div class="flex items-center justify-between mb-space-md">
                <h2 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[20px] text-tertiary">category</span>
                    Kategori Koleksi
                </h2>
                <span class="text-xs bg-surface-container-low px-2 py-0.5 rounded-full text-secondary font-semibold">
                    {{ $categories->count() }} Klasifikasi
                </span>
            </div>

            <div class="flex flex-col gap-space-sm flex-1">
                @foreach($categories as $category)
                    <a href="{{ route('books.index', ['category' => $category->id]) }}" 
                       class="p-3 rounded-lg bg-surface-container-low/60 border border-outline-variant/30 flex items-center justify-between hover:bg-surface-container hover:border-primary-container/40 transition-all group"
                       title="Lihat semua buku dalam kategori {{ $category->name }}">
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-on-surface group-hover:text-primary-container transition-colors">{{ $category->name }}</span>
                            <span class="text-[11px] text-secondary line-clamp-1">{{ $category->description ?? 'Kategori buku' }}</span>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-surface-container-lowest text-primary-container shadow-xs group-hover:bg-primary-container group-hover:text-white transition-colors">
                            {{ $category->books_count }} judul
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="mt-space-lg pt-space-sm border-t border-outline-variant/20 flex items-center justify-between text-xs text-secondary">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px] text-emerald-600">check_circle</span>
                    Katalog Sinkron
                </span>
                <span class="font-mono text-[11px]">UTS Web 2026</span>
            </div>
        </div>
    </div>
</div>
@endsection
