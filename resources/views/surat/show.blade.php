@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Arsip Surat</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nomor Surat:</strong> {{ $arsip->nomor_surat }}</p>
            <p><strong>Judul:</strong> {{ $arsip->judul }}</p>
            <p><strong>Kategori:</strong> {{ $arsip->kategori->nama ?? '-' }}</p>
            <p><strong>Waktu Arsip:</strong> {{ $arsip->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>File:</strong> 
                <a href="{{ route('arsip.download', $arsip->id) }}" class="btn btn-warning btn-sm">Unduh PDF</a>
            </p>
        </div>
    </div>

    <a href="{{ route('arsip.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
