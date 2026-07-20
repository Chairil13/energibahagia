<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahLembaga extends Model
{
    use HasFactory;

    protected $table = 'sejarah_lembagas';

    protected $fillable = [
        'badge_text',
        'title',
        'content',
        'institution_name',
        'is_active',
    ];
}
