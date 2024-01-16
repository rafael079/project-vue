<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\ExternalCreateByUrlRequest;
use App\Http\Resources\ExternalContentResource;
use App\Services\Content\ExternalContentService;

class ExternalContentController extends Controller
{
    public function getByUrl(ExternalCreateByUrlRequest $request, ExternalContentService $contentService)
    {
        $content = $contentService->get($request->url);

        return new ExternalContentResource($content);
    }
}
