<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramDonasi extends Model
{
    use HasFactory;

    protected $table = 'program_donasis';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'gambar',
        'id_kategori',
        'target_dana',
        'dana_terkumpul',
        'penerima',
        'jumlah_donatur',
        'tanggal_mulai',
        'tanggal_berakhir',
        'penulis',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'target_dana' => 'integer',
        'dana_terkumpul' => 'integer',
        'penerima' => 'integer',
        'jumlah_donatur' => 'integer',
        'is_featured' => 'boolean',
    ];

    // Auto generate slug
    public static function boot()
    {
        parent::boot();
        static::creating(function ($program) {
            $program->slug = Str::slug($program->judul) . '-' . uniqid();
        });
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriProgram::class, 'id_kategori');
    }

    // Hitung progress donasi
    public function getProgressAttribute()
    {
        if ($this->target_dana > 0) {
            return round(($this->dana_terkumpul / $this->target_dana) * 100, 1);
        }
        return 0;
    }

    // Scope untuk program aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'Aktif');
    }

    // Scope untuk program unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
