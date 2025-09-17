@extends('layouts.app')

@section('content')
<h3>Arsipkan Surat</h3>

<form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>No Surat</label>
        <input type="text" name="nomor" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>File (PDF)</label>
        <input type="file" name="file" class="form-control" accept="application/pdf" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
