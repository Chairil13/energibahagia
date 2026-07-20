<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi_singkat',
        'konten',
        'gambar',
        'penulis',
        'tanggal_publish',
        'kategori',
        'views',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'is_featured' => 'boolean',
    ];

    // Auto generate slug
    public static function boot()
    {
        parent::boot();
        static::creating(function ($berita) {
            $berita->slug = \Illuminate\Support\Str::slug($berita->judul) . '-' . uniqid();
        });
    }
}
