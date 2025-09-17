<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $surat = $query->get();
        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file')->store('arsip');

        Surat::create([
            'nomor' => $request->nomor,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file' => $path,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diarsipkan!');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        Storage::delete($surat->file);
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus!');
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        return Storage::download($surat->file, $surat->judul . ".pdf");
    }
}
