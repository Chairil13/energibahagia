<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misis';

    protected $fillable = [
        'badge_text',
        'title',
        'visi',
        'misi',
        'is_active',
    ];

    protected $casts = [
        'misi' => 'array',
    ];
}
