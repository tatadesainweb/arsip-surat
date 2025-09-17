<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ArsipSuratController extends Controller
{
    // Tampilkan semua arsip dengan fitur search
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            // Filter arsip berdasarkan judul
            $arsip = ArsipSurat::with('kategori')
                ->where('judul', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $arsip = ArsipSurat::with('kategori')->get();
        }

        return view('arsip.index', compact('arsip', 'keyword'));
    }

    // Form tambah arsip
    public function create()
    {
        $kategori = Kategori::all();
        return view('arsip.create', compact('kategori'));
    }

    // Simpan arsip baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'judul' => 'required',
            'kategori_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Upload file
        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);

        ArsipSurat::create([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'file' => $fileName,
        ]);

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    // Tampilkan detail arsip
    public function show($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        return view('arsip.show', compact('arsip'));
    }

    // Form edit arsip
    public function edit($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        $kategori = Kategori::all();
        return view('arsip.edit', compact('arsip', 'kategori'));
    }

    // Update arsip
    public function update(Request $request, $id)
    {
        $arsip = ArsipSurat::findOrFail($id);

        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
        ]);

        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $fileName);
            $arsip->update(['file' => $fileName]);
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    // Hapus arsip
    public function destroy($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }
}
