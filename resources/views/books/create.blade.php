@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="fade-in">
    <div class="page-header">
        <h1>Tambah Buku Baru</h1>
        <p>Isi formulir di bawah untuk menambahkan buku ke perpustakaan</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Judul Buku</label>
                <input type="text" id="title" name="title" class="form-control"
                       placeholder="Masukkan judul buku" value="{{ old('title') }}" required>
                @error('title')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="author">Penulis</label>
                    <input type="text" id="author" name="author" class="form-control"
                           placeholder="Nama penulis" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="publisher">Penerbit</label>
                    <input type="text" id="publisher" name="publisher" class="form-control"
                           placeholder="Nama penerbit" value="{{ old('publisher') }}" required>
                    @error('publisher')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="year">Tahun Terbit</label>
                    <input type="number" id="year" name="year" class="form-control"
                           placeholder="Contoh: 2024" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('year')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="stock">Jumlah Stok</label>
                    <input type="number" id="stock" name="stock" class="form-control"
                           placeholder="Jumlah stok" value="{{ old('stock', 0) }}" min="0" required>
                    @error('stock')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Kategori</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Buku
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
