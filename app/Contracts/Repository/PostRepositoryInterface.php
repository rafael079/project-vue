<?php

namespace App\Contracts\Repository;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface
{
    /**
     * @param Request $request
     * 
     * @return \App\Models\Post
     */
    public function create(Request $request): Post;
}