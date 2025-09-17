@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Arsip</h2>

    <p><strong>Nomor Surat:</strong> {{ $arsip->nomor_surat }}</p>
    <p><strong>Judul:</strong> {{ $arsip->judul }}</p>
    <p><strong>Kategori:</strong> {{ $arsip->kategori->nama ?? '-' }}</p>
    <p><strong>Waktu Pengarsipan:</strong> {{ $arsip->created_at->format('d-m-Y H:i') }}</p>

    <div class="mt-4">
        <h4>Isi File:</h4>
        <iframe src="{{ route('arsip.preview', $arsip->id) }}"
                width="100%" height="600px" style="border:1px solid #ddd;"></iframe>
    </div>

    <div class="mt-3">
        <a href="{{ route('arsip.download', $arsip->id) }}" class="btn btn-warning">Unduh</a>
        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
