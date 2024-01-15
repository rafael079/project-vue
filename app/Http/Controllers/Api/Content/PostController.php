<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\PostIndexRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    public function index(PostRepository $postRepository, PostIndexRequest $postIndexRequest)
    {
        return PostResource::collection($postRepository->getAllPostsPublished($postIndexRequest->validated()));
    }
}
