@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">About</h2>

    <div class="d-flex align-items-center">
        <!-- Foto kotak -->
        <div class="me-4">
            <img src="{{ asset($foto) }}" alt="Foto Saya" 
                 width="150" height="150" style="border:2px solid #007bff;">
        </div>

        <!-- Info pribadi -->
        <div>
            <p>{{ $nama }}</p>
            <p>NIM: {{ $nim }}</p>
            <p>Tanggal pembuatan aplikasi: {{ $tanggal }}</p>
        </div>
    </div>
</div>
@endsection
