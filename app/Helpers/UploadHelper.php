<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class UploadHelper
{
    public static function uploadImage(UploadedFile $file, $folder = 'hero')
    {
        $uploadPath = public_path('uploads/' . $folder);

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . uniqid() . '.' . $extension;

        $file->move($uploadPath, $fileName);

        return $folder . '/' . $fileName;
    }

    public static function deleteImage($path)
    {
        $fullPath = public_path('uploads/' . $path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }
        return false;
    }
}
