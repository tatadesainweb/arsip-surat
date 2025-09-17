<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'judul',
        'kategori_id',
        'file'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
