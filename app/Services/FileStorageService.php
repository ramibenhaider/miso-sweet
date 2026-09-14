<?php

namespace App\Services;

use App\Contracts\Services\FileStorageServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileStorageService implements FileStorageServiceInterface
{
    public function store(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        return $file->store($directory, $disk);
    }

    public function delete(string $path, string $disk = 'public'): bool
    {
        if ($this->exists($path, $disk)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }

    public function exists(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->exists($path);
    }
}
