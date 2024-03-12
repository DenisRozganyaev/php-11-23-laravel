<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService implements Contract\FileStorageServiceContract
{
    public function upload(string|UploadedFile $file, string $additionalPath = ''): string
    {
        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }

        $additionalPath = !empty($additionalPath) ? $additionalPath . '/' : '';

        $filePath = "public/$additionalPath" . Str::random() . '_' . time() . '.' . $file->getClientOriginalExtension();
        Storage::put($filePath, File::get($file));
        Storage::setVisibility($filePath, 'public');

        return $filePath;
    }

    public function remove(string $filePath): void
    {
        Storage::delete($filePath);
    }
}
