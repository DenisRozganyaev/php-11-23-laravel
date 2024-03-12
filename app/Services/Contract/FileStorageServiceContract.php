<?php

namespace App\Services\Contract;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceContract
{
    public function upload(UploadedFile|string $file, string $additionalPath = ''): string;

    public function remove(string $filePath): void;
}
