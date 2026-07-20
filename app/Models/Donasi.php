<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasis';

    protected $fillable = [
        'user_id',
        'program_id',
        'bank_id',
        'nama',
        'email',
        'phone',
        'pesan',
        'nominal',
        'bukti_transfer',
        'kode_unik',
        'status',
        'expires_at',
        'confirmed_at',
        'admin_note',
        'confirmed_by',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'nominal' => 'integer',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke program donasi
    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'program_id');
    }

    // Relasi ke bank
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    // Relasi ke admin yang mengkonfirmasi
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // Cek expired
    public function isExpired()
    {
        return now()->greaterThan($this->expires_at);
    }
}
