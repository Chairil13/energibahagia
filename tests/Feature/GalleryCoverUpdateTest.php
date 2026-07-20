<?php

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

test('gallery cover input belongs to the update form', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'is_active' => true,
    ]);
    $gallery = Gallery::create([
        'judul' => 'Galeri Pengujian',
        'deskripsi' => 'Deskripsi galeri',
        'status' => 'active',
        'urutan' => 1,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.gallery.edit', $gallery))
        ->assertOk()
        ->assertSee('id="formUpdateGallery"', false)
        ->assertSee('form="formUpdateGallery"', false);
});

test('admin can replace a gallery cover', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'is_active' => true,
    ]);
    $gallery = Gallery::create([
        'judul' => 'Galeri Pengujian',
        'deskripsi' => 'Deskripsi galeri',
        'status' => 'active',
        'urutan' => 1,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.gallery.update', $gallery), [
        'judul' => $gallery->judul,
        'deskripsi' => $gallery->deskripsi,
        'status' => $gallery->status,
        'urutan' => $gallery->urutan,
        'gambar_utama' => UploadedFile::fake()->image('sampul-baru.jpg'),
    ]);

    $response->assertRedirect(route('admin.gallery.index'));

    $coverFile = public_path('uploads/gallery/'.$gallery->fresh()->gambar_utama);

    expect($gallery->fresh()->gambar_utama)->not->toBeNull()
        ->and(file_exists($coverFile))->toBeTrue();

    if (file_exists($coverFile)) {
        unlink($coverFile);
    }
});
