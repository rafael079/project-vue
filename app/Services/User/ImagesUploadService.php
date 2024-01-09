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

    public function avatarUpload(UploadedFile $uploadedFile, string $oldUserAvatar = null)
    {
        $extension = $uploadedFile->getClientOriginalExtension();

        $image = $this->renameUploadedFile($extension);

        $avatar = Image::make($uploadedFile)
            ->orientate()
            ->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($extension);

        $upload = $this->makeUploadFile('users/avatar', $image, $avatar, $oldUserAvatar);

        if (!$upload) {
            return false;
        }

        return $image;
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

        $upload = $this->makeUploadFile('users/cover', $image, $cover, $oldUserCover);

        if (!$upload) {
            return false;
        }

        return $image;
    }

    private function makeUploadFile(string $path, string $file, \Intervention\Image\Image $image, string $oldFile = null): bool
    {
        $upload = $this->storage->put($path . "/" . $file, $image);

        if ($upload) {

            if ($oldFile) {
                if ($this->storage->exists($path . "/" . $oldFile)) {
                    $this->storage->delete($path . "/" . $oldFile);
                }
            }

            return true;
        }

        return false;
    }

    private function renameUploadedFile(string $extension): string
    {
        $name = strtolower(time() . '-' . md5(time()) . '.' . $extension);
        return $name;
    }
}