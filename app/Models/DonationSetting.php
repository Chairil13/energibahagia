<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationSetting extends Model
{
    protected $fillable = [
        'transfer_expiration_minutes',
    ];

    protected $casts = [
        'transfer_expiration_minutes' => 'integer',
    ];

    public static function current(): self
    {
        return self::query()->firstOrCreate([], [
            'transfer_expiration_minutes' => 60,
        ]);
    }
}
