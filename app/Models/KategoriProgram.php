<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriProgram extends Model
{
    use HasFactory;

    protected $table = 'kategori_programs';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'icon',
        'warna',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto generate slug
    public static function boot()
    {
        parent::boot();
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama_kategori);
        });
    }

    // Relasi ke program donasi
    public function programs()
    {
        return $this->hasMany(ProgramDonasi::class, 'id_kategori');
    }
}
