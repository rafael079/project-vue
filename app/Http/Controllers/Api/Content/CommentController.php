<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    public function getByPostId(string $post_id, CommentRepository $commentRepository)
    {
        return CommentResource::collection($commentRepository->getByPostId($post_id));
    }
}
