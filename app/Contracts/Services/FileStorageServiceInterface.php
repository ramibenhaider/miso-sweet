<?php

namespace App\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceInterface
{
    public function store(UploadedFile $file, string $directory, string $disk = 'public'): string;
    public function delete(string $path, string $disk = 'public'): bool;
    public function exists(string $path, string $disk = 'public'): bool;
}
