<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterDonaturRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'identity_number' => 'required|string|max:50|unique:users,identity_number',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:L,P',
            'occupation' => 'required|string|max:100',
            'emergency_contact' => 'required|string|max:20',
            'emergency_name' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'identity_number.unique' => 'Nomor identitas sudah terdaftar',
            'email.unique' => 'Email sudah digunakan',
            'birth_date.before' => 'Tanggal lahir harus sebelum hari ini',
        ];
    }
}
