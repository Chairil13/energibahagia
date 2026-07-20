<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar_utama',
        'status',
        'urutan'
    ];

    // Relasi ke foto-foto
    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('urutan', 'asc');
    }

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->slug = Str::slug($gallery->judul) . '-' . time();
        });

        static::updating(function ($gallery) {
            if ($gallery->isDirty('judul')) {
                $gallery->slug = Str::slug($gallery->judul) . '-' . time();
            }
        });
    }

    // Scope aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Accessor untuk foto utama
    public function getGambarUtamaUrlAttribute()
    {
        if ($this->gambar_utama) {
            return asset('uploads/gallery/' . $this->gambar_utama);
        }
        return asset('images/no-image.jpg');
    }
}
