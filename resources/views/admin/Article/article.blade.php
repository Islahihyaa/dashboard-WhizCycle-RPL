@extends('admin.layouts.main')

@section('content')
    <h1>Buat Artikel Edukasi Lingkungan</h1>

    <form method="POST" action="{{ route('admin.artikel-edukasi-lingkungan.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control-file" id="foto" name="foto" required>
        </div>

        <button type="submit" class="btn btn-primary">Buat Artikel</button>
    </form>
@endsection
