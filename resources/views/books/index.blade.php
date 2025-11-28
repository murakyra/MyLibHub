@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Buku</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="width: 50px; height: auto;">
                        @else
                            <img src="{{ asset('images/default_cover.png') }}" alt="No Cover" style="width: 50px; height: auto;">
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada buku yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $books->links() }}
@endsection