@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Arsip Surat</h2>
    <a href="{{ route('arsip.create') }}" class="btn btn-primary mb-3">Tambah Arsip</a>

    <!-- Form Search -->
    <form action="{{ route('arsip.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari judul arsip" value="{{ $keyword ?? '' }}">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nomor_surat }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->kategori->nama ?? '-' }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('arsip.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('arsip.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Tombol Hapus menggunakan modal -->
                    <button class="btn btn-danger btn-sm btn-delete" data-url="{{ route('arsip.destroy', $item->id) }}">
                        Hapus
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Data tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
