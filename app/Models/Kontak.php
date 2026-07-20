<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontaks';

    protected $fillable = [
        'hero_badge',
        'hero_title_first',
        'hero_title_highlight',
        'hero_description',
        'office_address',
        'office_map_link',
        'phone_kantor',
        'phone_hotline',
        'phone_darurat',
        'email_umum',
        'email_donasi',
        'email_humas',
        'social_facebook',
        'social_instagram',
        'social_twitter',
        'social_youtube',
        'social_linkedin',
        'whatsapp_number',
        'is_active',
    ];
}
