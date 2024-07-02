<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    protected function uploadFile(mixed $file, string $directory): string
    {
        $fileName = $this->getFileName($file);

        $realPath = $directory . $fileName;

        Storage::disk('public')->put($realPath, file_get_contents($file));

        $filePath   = 'storage' . $realPath;


        $request = request();
        // Add the uploaded file path to the request to enable file cleanup in case of exceptions
        $request->merge(['uploadedFiles' => array_merge($request->input('uploadedFiles', []), [$filePath])]);

        return $filePath;
    }

    protected function getFileName(object $file): string
    {
        return  Carbon::now()->format('Y_m_d_u') . '_' . $file->getClientOriginalName();
    }

    protected function deleteFile($fileName): bool
    {
        if (file_exists(public_path($fileName))) {
            unlink(public_path($fileName));
            return true;
        }
        return false;
    }

    protected function getFileExtension(string $filePath): string
    {
        $infoPath = pathinfo(public_path($filePath));

        return $infoPath['extension'];
    }
}
