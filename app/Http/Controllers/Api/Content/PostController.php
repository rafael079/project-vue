<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(PostRepository $postRepository)
    {
        return PostResource::collection($postRepository->getAllPostsPublished());
    }
}
