@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded-start" alt="{{ $book->title }}">
                @else
                    <img src="{{ asset('images/default_cover.png') }}" class="img-fluid rounded-start" alt="No Cover">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $book->title }}</h1>
                    <p class="card-text"><strong>Penulis:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</p>
                    <p class="card-text"><strong>Tahun Terbit:</strong> {{ $book->publication_year ?? '-' }}</p>
                    <p class="card-text"><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $book->description ?? '-' }}</p>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                    </form>
                    <a href="{{ route('books.index') }}" class="btn btn-dark">Kembali ke Daftar Buku</a>
                </div>
            </div>
        </div>
    </div>
@endsection