<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $table = 'hero_sections';

    protected $fillable = [
        'badge_text',
        'title_first',
        'title_highlight',
        'title_last',
        'description',
        'button_primary_text',
        'button_primary_link',
        'button_secondary_text',
        'button_secondary_link',
        'hero_image',
        'is_active',
    ];
}
