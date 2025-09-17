@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Arsip Surat</h2>

    {{-- Search --}}
    <form action="{{ route('arsip.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Cari judul surat..." value="{{ request('keyword') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    {{-- Tombol tambah surat --}}
    <a href="{{ route('arsip.create') }}" class="btn btn-success mb-3">Arsipkan Surat..</a>

    {{-- Tabel data --}}
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Nomor Surat</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>File</th>
                <th class="text-center" style="width: 220px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $a)
            <tr>
                <td>{{ $a->nomor_surat }}</td>
                <td>{{ $a->judul }}</td>
                <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $a->file }}</td>
                <td class="text-center">
                    <a href="{{ route('arsip.show', $a->id) }}" class="btn btn-info btn-sm">Lihat >></a>
                    <a href="{{ asset('storage/' . $a->file) }}" class="btn btn-warning btn-sm" download>Unduh</a>

                    <!-- Tombol Hapus dengan Modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $a->id }}">
                        Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal Konfirmasi Hapus -->
            <div class="modal fade" id="hapusModal{{ $a->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $a->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"> <!-- Supaya muncul di tengah -->
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="hapusModalLabel{{ $a->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda yakin ingin menghapus arsip <br><strong>{{ $a->judul }}</strong>?</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('arsip.destroy', $a->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada arsip surat</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
