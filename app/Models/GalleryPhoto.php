<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'foto',
        'keterangan',
        'urutan'
    ];

    // Relasi ke gallery
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    // Accessor URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('uploads/gallery/photos/' . $this->foto);
        }
        return asset('images/no-image.jpg');
    }
}
