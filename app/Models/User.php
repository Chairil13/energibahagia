<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'identity_number',
        'birth_date',
        'gender',
        'occupation',
        'emergency_contact',
        'emergency_name',
        'profile_photo',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    // ============ HELPER METHODS ============

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDonatur(): bool
    {
        return $this->role === 'donatur';
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    // ============ SCOPES ============

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeDonaturs($query)
    {
        return $query->where('role', 'donatur');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ============ ACCESSORS ============

    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->province} - {$this->postal_code}";
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // ============ RELATIONSHIPS ============

    // Contoh relasi ke donasi (sesuaikan dengan kebutuhan)
    // public function donations()
    // {
    //     return $this->hasMany(Donation::class);
    // }

}
