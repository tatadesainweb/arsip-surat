<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['nama']; // ganti nama_kategori -> nama

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'kategori_id');
    }
}