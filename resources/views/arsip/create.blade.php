@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Unggah Arsip Surat</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="1">Undangan</option>
                <option value="2">Pengumuman</option>
                <option value="3">Nota Dinas</option>
                <option value="4">Pemberitahuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>File (PDF)</label>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>

        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
