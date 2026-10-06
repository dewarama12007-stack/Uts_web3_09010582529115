@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="fade-in">
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan perpustakaan.</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card purple fade-in stagger-1">
            <div class="stat-icon purple">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalBooks }}</h3>
                <p>Total Buku</p>
            </div>
        </div>

        <div class="stat-card blue fade-in stagger-2">
            <div class="stat-icon blue">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalCategories }}</h3>
                <p>Kategori</p>
            </div>
        </div>

        <div class="stat-card green fade-in stagger-3">
            <div class="stat-icon green">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalStock }}</h3>
                <p>Total Stok</p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <!-- Recent Books -->
        <div class="card fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h2 class="card-title" style="margin-bottom: 0;">
                    <i class="fas fa-clock" style="color: #818cf8; margin-right: 6px;"></i>
                    Buku Terbaru
                </h2>
                <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            @if($recentBooks->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBooks as $book)
                                <tr>
                                    <td>
                                        <a href="{{ route('books.show', $book) }}" style="color: #a5b4fc; text-decoration: none; font-weight: 500;">
                                            {{ $book->title }}
                                        </a>
                                    </td>
                                    <td style="color: #94a3b8;">{{ $book->author }}</td>
                                    <td>
                                        <span class="badge badge-primary">{{ $book->category->name }}</span>
                                    </td>
                                    <td>
                                        @if($book->stock > 5)
                                            <span class="badge badge-success">{{ $book->stock }}</span>
                                        @elseif($book->stock > 0)
                                            <span class="badge badge-warning">{{ $book->stock }}</span>
                                        @else
                                            <span class="badge badge-danger">Habis</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Belum ada buku</h3>
                    <p>Mulai tambahkan buku ke perpustakaan.</p>
                </div>
            @endif
        </div>

        <!-- Categories Sidebar -->
        <div class="card fade-in">
            <h2 class="card-title">
                <i class="fas fa-layer-group" style="color: #38bdf8; margin-right: 6px;"></i>
                Kategori
            </h2>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                @foreach($categories as $category)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(15, 23, 42, 0.4); border-radius: 10px; border: 1px solid rgba(51, 65, 85, 0.4);">
                        <div>
                            <div style="font-weight: 600; font-size: 0.9rem; color: #e2e8f0;">{{ $category->name }}</div>
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 2px;">{{ Str::limit($category->description, 40) }}</div>
                        </div>
                        <span class="badge badge-primary">{{ $category->books_count }} buku</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .main-content > .fade-in > div:last-child {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
