@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="fade-in">
    <div class="page-header">
        <h1>Edit Buku</h1>
        <p>Perbarui informasi buku "{{ $book->title }}"</p>
    </div>

    <div class="card" style="max-width: 800px;">
        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul Buku</label>
                <input type="text" id="title" name="title" class="form-control"
                       placeholder="Masukkan judul buku" value="{{ old('title', $book->title) }}" required>
                @error('title')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="author">Penulis</label>
                    <input type="text" id="author" name="author" class="form-control"
                           placeholder="Nama penulis" value="{{ old('author', $book->author) }}" required>
                    @error('author')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="publisher">Penerbit</label>
                    <input type="text" id="publisher" name="publisher" class="form-control"
                           placeholder="Nama penerbit" value="{{ old('publisher', $book->publisher) }}" required>
                    @error('publisher')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="year">Tahun Terbit</label>
                    <input type="number" id="year" name="year" class="form-control"
                           placeholder="Contoh: 2024" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('year')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="stock">Jumlah Stok</label>
                    <input type="number" id="stock" name="stock" class="form-control"
                           placeholder="Jumlah stok" value="{{ old('stock', $book->stock) }}" min="0" required>
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
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
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
                    <i class="fas fa-save"></i> Perbarui Buku
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
