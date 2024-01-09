<?php

namespace App\Services\User;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesUploadService
{

    private Filesystem $storage;

    public function __construct()
    {
        $this->storage = Storage::disk(config('uploads.disk'));
    }

    public function coverUpload(UploadedFile $uploadedFile, string $oldUserCover = null): string|bool
    {
        $extension = $uploadedFile->getClientOriginalExtension();

        $image = $this->renameUploadedFile($extension);

        $cover = Image::make($uploadedFile)
            ->orientate()
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($extension);

        $upload = $this->storage->put("users/cover/{$image}", $cover);

        if (!$upload) {
            return false;
        }

        if ($oldUserCover) {
            if ($this->storage->exists("users/cover/{$oldUserCover}")) {
                $this->storage->delete("users/cover/{$oldUserCover}");
            }
        }

        return $image;
    }

    private function renameUploadedFile(string $extension): string
    {
        $name = strtolower(time() . '-' . md5(time()) . '.' . $extension);
        return $name;
    }
}