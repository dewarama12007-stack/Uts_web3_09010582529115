@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div class="page-header" style="margin-bottom: 0;">
            <h1>Detail Buku</h1>
            <p>Informasi lengkap tentang buku</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card" style="max-width: 800px;">
        <!-- Book Title Header -->
        <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(51, 65, 85, 0.5);">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: white; flex-shrink: 0;">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h2 style="font-size: 1.4rem; font-weight: 700; color: #f1f5f9; margin-bottom: 4px;">{{ $book->title }}</h2>
                    <span class="badge badge-primary" style="font-size: 0.8rem;">{{ $book->category->name }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Grid -->
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-user" style="margin-right: 4px;"></i> Penulis</div>
                <div class="detail-value">{{ $book->author }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-building" style="margin-right: 4px;"></i> Penerbit</div>
                <div class="detail-value">{{ $book->publisher }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-calendar" style="margin-right: 4px;"></i> Tahun Terbit</div>
                <div class="detail-value">{{ $book->year }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-cubes" style="margin-right: 4px;"></i> Stok</div>
                <div class="detail-value">
                    @if($book->stock > 5)
                        <span class="badge badge-success" style="font-size: 0.9rem;">{{ $book->stock }} tersedia</span>
                    @elseif($book->stock > 0)
                        <span class="badge badge-warning" style="font-size: 0.9rem;">{{ $book->stock }} tersedia</span>
                    @else
                        <span class="badge badge-danger" style="font-size: 0.9rem;">Stok Habis</span>
                    @endif
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-tag" style="margin-right: 4px;"></i> Kategori</div>
                <div class="detail-value">{{ $book->category->name }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-clock" style="margin-right: 4px;"></i> Ditambahkan</div>
                <div class="detail-value">{{ $book->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <!-- Actions -->
        <div style="display: flex; gap: 12px; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(51, 65, 85, 0.5);">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Buku
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" style="margin:0;"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Buku
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
