<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CoverUploadRequest;
use App\Services\User\ImagesUploadService;
use Illuminate\Http\Request;

class UploadImagesController extends Controller
{
    public function cover(CoverUploadRequest $coverUploadRequest, ImagesUploadService $imagesUploadService)
    {
        $cover = $imagesUploadService->coverUpload($coverUploadRequest->file('cover'), auth()->user()->cover);

        if ($cover) {
            $coverUploadRequest->user()->update(['cover' => $cover]);

            return back()->with('success', __('Your Profile Has Been Updated!'));
        }

        return back()->with('error', __('An error occurred here. Try again'));
    }
}
