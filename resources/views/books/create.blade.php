@extends('layouts.app')

@section('content')
    <h1>Tambah Buku Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}">
        </div>
        <div class="mb-3">
            <label for="publication_year" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" min="1000" max="{{ date('Y') }}">
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Gambar Cover</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Buku</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection