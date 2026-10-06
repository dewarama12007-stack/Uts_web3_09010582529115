@extends('layouts.app')

@section('title', 'Detail Buku - ' . $book->title)

@section('content')
@php
    $catName = strtolower($book->category->name ?? '');
    if (str_contains($catName, 'fiksi')) {
        $cardGradient = 'from-indigo-950 via-purple-900 to-slate-900';
        $accentColor = '#c084fc';
    } elseif (str_contains($catName, 'teknologi')) {
        $cardGradient = 'from-slate-950 via-blue-900 to-indigo-950';
        $accentColor = '#38bdf8';
    } elseif (str_contains($catName, 'sains') || str_contains($catName, 'non')) {
        $cardGradient = 'from-slate-950 via-emerald-900 to-teal-950';
        $accentColor = '#34d399';
    } else {
        $cardGradient = 'from-primary-container via-primary to-inverse-surface';
        $accentColor = '#89f5e7';
    }
@endphp

<style>
    @media print {
        aside, header, #sidebar-backdrop, .no-print { display: none !important; }
        .lg\:pl-\[260px\] { padding-left: 0 !important; }
        main { padding: 0 !important; }
        body { background: white !important; color: black !important; }
    }
</style>

<div class="max-w-5xl mx-auto w-full flex flex-col gap-space-lg">
    <!-- Header & Action Navigation -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md no-print">
        <div class="flex flex-col">
            <a href="{{ route('books.index') }}" 
               class="text-primary-container hover:text-primary font-semibold text-xs inline-flex items-center gap-1 mb-1 transition-colors group">
                <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                <span>Kembali ke Daftar Buku</span>
            </a>
            <div class="flex items-baseline gap-space-sm flex-wrap">
                <h1 class="font-headline-xl text-2xl sm:text-3xl font-bold text-on-surface tracking-tight">Detail Buku</h1>
                <span class="text-xs text-secondary font-mono">ID: BUKU-{{ str_pad($book->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <p class="text-xs text-secondary mt-0.5">Informasi bibliografis lengkap, status inventaris, dan metadata katalog.</p>
        </div>

        <div class="flex items-center gap-space-sm self-start md:self-auto flex-wrap">
            <!-- Print Button -->
            <button type="button" 
                    onclick="window.print()" 
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold text-slate-700 bg-surface-container-lowest hover:bg-surface-container-low transition-colors border border-slate-300 shadow-xs cursor-pointer"
                    title="Cetak kartu katalog buku">
                <span class="material-symbols-outlined text-[18px]">print</span>
                <span>Cetak Kartu</span>
            </button>

            <!-- Edit Button -->
            <a href="{{ route('books.edit', $book) }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold text-white bg-primary-container hover:bg-primary transition-colors shadow-xs">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit Buku</span>
            </a>

            <!-- Delete Form -->
            <form action="{{ route('books.destroy', $book) }}" 
                  method="POST" 
                  class="m-0"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $book->title }}\'? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white transition-colors border border-red-200 cursor-pointer shadow-xs">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Detail Card -->
    <div class="bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 overflow-hidden p-6 sm:p-8 flex flex-col gap-space-xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: 3D Book Mockup Card (Span 4) -->
            <div class="lg:col-span-4 flex flex-col items-center">
                <div class="w-64 h-96 rounded-xl bg-gradient-to-br {{ $cardGradient }} p-6 text-white shadow-xl flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-white/10 blur-xl pointer-events-none"></div>
                    <div class="absolute -left-12 bottom-12 w-32 h-32 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                    
                    <div class="flex items-center justify-between z-10">
                        <span class="font-mono text-[10px] tracking-wider uppercase px-2 py-0.5 rounded bg-white/20 text-white backdrop-blur-sm">
                            EDISI RESMI
                        </span>
                        <span class="material-symbols-outlined text-white/70 text-[20px]">local_library</span>
                    </div>

                    <div class="my-auto py-4 z-10 flex flex-col gap-1">
                        <span class="text-[11px] uppercase tracking-widest text-primary-fixed-dim/90 font-semibold">
                            {{ $book->category->name }}
                        </span>
                        <h2 class="text-xl font-bold text-white leading-tight drop-shadow-sm line-clamp-3">
                            {{ $book->title }}
                        </h2>
                        <div class="w-8 h-0.5 bg-yellow-400 my-2"></div>
                        <p class="text-sm text-primary-fixed-dim tracking-wide font-medium">
                            {{ $book->author }}
                        </p>
                    </div>

                    <div class="z-10 flex flex-col gap-2 pt-4 border-t border-white/10">
                        <div class="flex items-center justify-between text-[11px] text-white/80">
                            <span>{{ $book->publisher }}</span>
                            <span class="font-mono">{{ $book->year }}</span>
                        </div>
                        <div class="w-full flex items-center justify-between px-2 py-1.5 rounded bg-black/20">
                            <!-- Stylized Barcode SVG -->
                            <svg class="h-4 w-28 text-white/80" fill="currentColor" viewBox="0 0 120 20">
                                <rect x="0" y="0" width="3" height="20"></rect>
                                <rect x="5" y="0" width="1" height="20"></rect>
                                <rect x="8" y="0" width="4" height="20"></rect>
                                <rect x="15" y="0" width="2" height="20"></rect>
                                <rect x="19" y="0" width="1" height="20"></rect>
                                <rect x="23" y="0" width="3" height="20"></rect>
                                <rect x="28" y="0" width="5" height="20"></rect>
                                <rect x="36" y="0" width="2" height="20"></rect>
                                <rect x="40" y="0" width="4" height="20"></rect>
                                <rect x="46" y="0" width="1" height="20"></rect>
                                <rect x="50" y="0" width="3" height="20"></rect>
                                <rect x="55" y="0" width="2" height="20"></rect>
                                <rect x="60" y="0" width="5" height="20"></rect>
                                <rect x="68" y="0" width="1" height="20"></rect>
                                <rect x="72" y="0" width="3" height="20"></rect>
                                <rect x="78" y="0" width="2" height="20"></rect>
                                <rect x="83" y="0" width="4" height="20"></rect>
                                <rect x="90" y="0" width="1" height="20"></rect>
                                <rect x="94" y="0" width="3" height="20"></rect>
                                <rect x="100" y="0" width="4" height="20"></rect>
                                <rect x="107" y="0" width="2" height="20"></rect>
                                <rect x="112" y="0" width="3" height="20"></rect>
                            </svg>
                            <span class="font-mono text-[9px] text-white/80">#{{ $book->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-1.5 text-secondary text-xs">
                    <span class="material-symbols-outlined text-[16px] text-emerald-600">verified</span>
                    <span>Verifikasi Katalog Resmi</span>
                </div>
            </div>

            <!-- Right: Bibliographic Data (Span 8) -->
            <div class="lg:col-span-8 flex flex-col justify-between gap-6">
                <div class="flex flex-col gap-4">
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="bg-primary-fixed text-primary-container text-xs font-semibold px-3 py-1 rounded-full inline-flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">auto_stories</span>
                            {{ $book->category->name }}
                        </span>
                        <span class="bg-surface-container-low text-secondary text-xs px-3 py-1 rounded-full font-medium">
                            Kategori ID: #{{ $book->category_id }}
                        </span>
                        <span class="bg-slate-100 text-slate-700 text-xs px-3 py-1 rounded-full font-mono">
                            Tahun: {{ $book->year }}
                        </span>
                    </div>

                    <!-- Title & Details -->
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-on-surface tracking-tight">{{ $book->title }}</h2>
                        <p class="text-sm text-secondary mt-1 flex items-center gap-2 flex-wrap">
                            <span class="font-medium text-slate-800">Penulis: {{ $book->author }}</span>
                            <span class="text-outline-variant">•</span>
                            <span>Penerbit: {{ $book->publisher }}</span>
                            <span class="text-outline-variant">•</span>
                            <span>Edisi Fisik</span>
                        </p>
                    </div>

                    <!-- Description / Category Note -->
                    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 text-slate-700">
                        <div class="text-xs font-semibold text-secondary uppercase tracking-wider mb-1">Klasifikasi Koleksi:</div>
                        <p class="text-sm leading-relaxed">
                            {{ $book->category->description ?? 'Buku terdaftar resmi dalam repositori perpustakaan dengan data bibliografi yang telah diverifikasi.' }}
                        </p>
                    </div>

                    <!-- Detail Spec Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Penulis
                            </div>
                            <div class="text-sm font-semibold text-slate-900">{{ $book->author }}</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Penerbit
                            </div>
                            <div class="text-sm font-semibold text-slate-900">{{ $book->publisher }}</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Tahun Terbit
                            </div>
                            <div class="text-sm font-semibold text-slate-900">{{ $book->year }}</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Ketersediaan Stok Fisik
                            </div>
                            <div>
                                @if($book->stock > 5)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        {{ $book->stock }} eksemplar tersedia
                                    </span>
                                @elseif($book->stock > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        {{ $book->stock }} eksemplar tersedia (Terbatas)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                        Stok Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Tanggal Registrasi
                            </div>
                            <div class="text-xs font-mono text-slate-700">{{ $book->created_at->format('d M Y, H:i') }} WIB</div>
                        </div>

                        <div class="p-3.5 rounded-lg bg-white border border-slate-200">
                            <div class="text-[11px] font-semibold text-secondary uppercase tracking-wider mb-1">
                                Terakhir Diperbarui
                            </div>
                            <div class="text-xs font-mono text-slate-700">{{ $book->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Back / Edit Bar -->
                <div class="pt-4 border-t border-outline-variant/20 flex items-center justify-between no-print">
                    <a href="{{ route('books.index') }}" 
                       class="text-xs font-semibold text-secondary hover:text-slate-900 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        <span>Kembali ke daftar</span>
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('books.edit', $book) }}" 
                           class="px-4 py-2 rounded-lg text-xs font-semibold text-white bg-primary-container hover:bg-primary transition-colors">
                            Perbarui Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
