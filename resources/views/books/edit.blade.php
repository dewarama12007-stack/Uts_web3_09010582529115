@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="max-w-5xl mx-auto w-full flex flex-col gap-space-lg">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col gap-space-xs">
        <div class="flex items-center gap-space-xs text-xs text-secondary">
            <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">dashboard</span>
                <span>Dashboard</span>
            </a>
            <span class="text-outline-variant font-mono">/</span>
            <a href="{{ route('books.index') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">menu_book</span>
                <span>Daftar Buku</span>
            </a>
            <span class="text-outline-variant font-mono">/</span>
            <span class="text-primary-container font-semibold">Edit Buku</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md pt-space-xs">
            <div class="flex items-center gap-space-sm">
                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary-container shadow-xs">
                    <span class="material-symbols-outlined text-[24px]">edit_note</span>
                </div>
                <div>
                    <h1 class="font-headline-xl text-2xl sm:text-3xl font-bold text-on-surface tracking-tight">Edit Buku</h1>
                    <p class="font-body-md text-sm text-secondary mt-0.5">
                        Perbarui informasi buku <strong class="text-on-surface">"{{ $book->title }}"</strong> dalam inventaris perpustakaan.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-space-sm">
                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container-lowest shadow-xs border border-outline-variant/30 text-secondary text-xs font-mono">
                    <span class="material-symbols-outlined text-[16px] text-primary-container">qr_code_2</span>
                    <span>ID: #{{ $book->id }}</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
        <!-- Form Surface (Span 8) -->
        <div class="lg:col-span-8 bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 overflow-hidden">
            <div class="px-6 py-4 bg-surface-container-low/40 border-b border-outline-variant/20 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary-fixed/60 flex items-center justify-center text-primary-container">
                        <span class="material-symbols-outlined text-[20px]">menu_book</span>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-on-surface">Formulir Metadata Katalog</h2>
                        <p class="text-xs text-secondary">Pastikan data katalog sinkron dengan nomor registrasi fisik.</p>
                    </div>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-surface-container text-on-surface">
                    {{ $book->category->name }}
                </span>
            </div>

            <form action="{{ route('books.update', $book) }}" method="POST" class="p-6 sm:p-8 flex flex-col gap-space-lg">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-space-lg gap-y-space-md">
                    <!-- Judul Buku -->
                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="title">
                                Judul Buku
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('title')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                class="w-full h-11 px-3.5 pl-10 rounded-lg border {{ $errors->has('title') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                                placeholder="Masukkan judul buku" 
                                value="{{ old('title', $book->title) }}" 
                                required
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">auto_stories</span>
                            </div>
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="author">
                                Penulis
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('author')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="author" 
                                name="author" 
                                class="w-full h-11 px-3.5 pl-10 rounded-lg border {{ $errors->has('author') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                                placeholder="Nama penulis" 
                                value="{{ old('author', $book->author) }}" 
                                required
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">person_edit</span>
                            </div>
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="publisher">
                                Penerbit
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('publisher')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="publisher" 
                                name="publisher" 
                                class="w-full h-11 px-3.5 pl-10 rounded-lg border {{ $errors->has('publisher') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                                placeholder="Nama penerbit" 
                                value="{{ old('publisher', $book->publisher) }}" 
                                required
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">apartment</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="year">
                                Tahun Terbit
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('year')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <input 
                                type="number" 
                                id="year" 
                                name="year" 
                                min="1900" 
                                max="{{ date('Y') + 1 }}"
                                class="w-full h-11 px-3.5 pl-10 rounded-lg border {{ $errors->has('year') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                                placeholder="Contoh: 2024" 
                                value="{{ old('year', $book->year) }}" 
                                required
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stok Fisik -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="stock">
                                Stok Fisik
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('stock')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <input 
                                type="number" 
                                id="stock" 
                                name="stock" 
                                min="0"
                                class="w-full h-11 px-3.5 pl-10 rounded-lg border {{ $errors->has('stock') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                                placeholder="Contoh: 10" 
                                value="{{ old('stock', $book->stock) }}" 
                                required
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Dropdown (col-span-2) -->
                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface flex items-center gap-1" for="category_id">
                                Kategori Buku
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            @error('category_id')
                                <span class="font-mono text-xs text-red-600 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="relative">
                            <select 
                                id="category_id" 
                                name="category_id" 
                                class="w-full h-11 pl-10 pr-10 rounded-lg border {{ $errors->has('category_id') ? 'border-red-400 bg-red-50/50' : 'border-slate-300 bg-white' }} text-on-surface text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-primary-container transition-all cursor-pointer"
                                required
                            >
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->description ?? 'Klasifikasi' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">category</span>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-[20px]">expand_more</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-space-sm pt-space-lg border-t border-outline-variant/20">
                    <a href="{{ route('books.index') }}" 
                       class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-semibold text-secondary bg-surface-container-low hover:bg-surface-container text-center transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        <span>Batal</span>
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-primary-container hover:bg-primary shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Perbarui Buku</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Book Preview Card (Span 4) -->
        <div class="lg:col-span-4 bg-surface-container-lowest rounded-xl shadow-xs border border-outline-variant/30 p-6 flex flex-col gap-4">
            <h3 class="text-sm font-bold text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px] text-primary-container">preview</span>
                Ringkasan Koleksi
            </h3>

            <div class="p-4 rounded-xl bg-gradient-to-br from-primary-container via-primary to-inverse-surface text-white shadow-md relative overflow-hidden flex flex-col justify-between h-56">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2 py-0.5 rounded bg-white/20 text-white font-mono text-[10px]">EDISI KATALOG</span>
                    <span class="material-symbols-outlined text-[20px] text-white/70">local_library</span>
                </div>
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-primary-fixed-dim">{{ $book->category->name }}</span>
                    <h4 class="text-lg font-bold text-white leading-snug line-clamp-2">{{ $book->title }}</h4>
                    <p class="text-xs text-primary-fixed-dim/90 mt-1">{{ $book->author }}</p>
                </div>
                <div class="flex items-center justify-between text-[11px] text-white/80 pt-2 border-t border-white/10 font-mono">
                    <span>{{ $book->publisher }}</span>
                    <span>{{ $book->year }}</span>
                </div>
            </div>

            <div class="flex flex-col gap-2 pt-2 border-t border-outline-variant/20 text-xs text-secondary">
                <div class="flex justify-between">
                    <span>Stok Saat Ini:</span>
                    <strong class="text-on-surface">{{ $book->stock }} eksemplar</strong>
                </div>
                <div class="flex justify-between">
                    <span>Dibuat:</span>
                    <span class="font-mono text-on-surface">{{ $book->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Terakhir Update:</span>
                    <span class="font-mono text-on-surface">{{ $book->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
