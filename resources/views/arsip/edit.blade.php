@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Arsip</h2>

    <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomor_surat" class="form-label">Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control" value="{{ $arsip->nomor_surat }}">
        </div>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $arsip->judul }}">
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" @if($arsip->kategori_id == $k->id) selected @endif>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File (PDF)</label>
            <input type="file" name="file" class="form-control">
            <small>File lama: <a href="{{ route('arsip.download', $arsip->id) }}">Download</a></small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
