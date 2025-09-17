<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    // Halaman index (daftar arsip + search)
    public function index(Request $request)
{
    // Ambil kata kunci dari input search
    $keyword = $request->input('keyword');

    // Query arsip dengan relasi kategori dan filter jika ada keyword
    $arsip = Arsip::with('kategori')
        ->when($keyword, function ($query, $keyword) {
            return $query->where('judul', 'like', "%{$keyword}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // Kirim ke view
    return view('arsip.index', compact('arsip', 'keyword'));
}


    // Halaman create
    public function create()
    {
        return view('arsip.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'judul' => 'required',
            'kategori_id' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan file ke storage/app/public/arsip
        $path = $request->file('file')->store('arsip', 'public');

        Arsip::create([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'file' => $path,
        ]);

        return redirect()->route('arsip.index')->with('success', 'Data berhasil disimpan');
    }

    // Tampilkan detail arsip
    public function show($id)
    {
        $arsip = Arsip::with('kategori')->findOrFail($id);
        return view('arsip.show', compact('arsip'));
    }

    // Preview file (tampil di iframe, bukan download)
    public function preview($id)
    {
        $arsip = Arsip::findOrFail($id);
        $filePath = storage_path('app/public/' . $arsip->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($filePath);
    }

    // Form edit arsip
public function edit($id)
{
    $arsip = Arsip::findOrFail($id);
    $kategori = Kategori::all();
    return view('arsip.edit', compact('arsip', 'kategori'));
}

// Update arsip
public function update(Request $request, $id)
{
    $arsip = Arsip::findOrFail($id);

    $request->validate([
        'nomor_surat' => 'required',
        'judul' => 'required',
        'kategori_id' => 'required',
        'file' => 'nullable|mimes:pdf|max:2048',
    ]);

    $arsip->update([
        'nomor_surat' => $request->nomor_surat,
        'judul' => $request->judul,
        'kategori_id' => $request->kategori_id,
    ]);

    // Jika ada file baru, update file
    if ($request->hasFile('file')) {
        // Hapus file lama
        if (Storage::disk('public')->exists($arsip->file)) {
            Storage::disk('public')->delete($arsip->file);
        }

        $path = $request->file('file')->store('arsip', 'public');
        $arsip->update(['file' => $path]);
    }

    return redirect()->route('arsip.index')->with('success', 'Data berhasil diperbarui');
}


    // Download file
    public function download($id)
    {
        $arsip = Arsip::findOrFail($id);
        return Storage::disk('public')->download($arsip->file);
    }

    // Hapus data
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        if (Storage::disk('public')->exists($arsip->file)) {
            Storage::disk('public')->delete($arsip->file);
        }

        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Data berhasil dihapus');
    }
}
