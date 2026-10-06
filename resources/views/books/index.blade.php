@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div class="page-header" style="margin-bottom: 0;">
            <h1>Daftar Buku</h1>
            <p>Kelola seluruh koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>

    <!-- Search & Filter Toolbar (BONUS) -->
    <form method="GET" action="{{ route('books.index') }}" class="toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari judul atau penulis..."
                value="{{ request('search') }}"
            >
        </div>
        <select name="category" class="form-control filter-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">
            <i class="fas fa-search"></i> Cari
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Reset
            </a>
        @endif
    </form>

    <!-- Books Table -->
    <div class="card">
        @if($books->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $index => $book)
                            <tr>
                                <td style="color: #64748b;">{{ $books->firstItem() + $index }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book) }}" style="color: #a5b4fc; text-decoration: none; font-weight: 600;">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td style="color: #cbd5e1;">{{ $book->author }}</td>
                                <td style="color: #94a3b8;">{{ $book->publisher }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $book->year }}</span>
                                </td>
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
                                <td>
                                    <div class="actions-cell">
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="margin:0;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $books->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>Tidak ada buku ditemukan</h3>
                @if(request('search') || request('category'))
                    <p>Coba ubah kata kunci pencarian atau filter kategori.</p>
                @else
                    <p>Belum ada buku di perpustakaan. Mulai tambahkan sekarang!</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="fas fa-plus"></i> Tambah Buku Pertama
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
