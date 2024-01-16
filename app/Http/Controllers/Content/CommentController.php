<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\CommentStoreRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $commentStoreRequest, CommentRepository $commentRepository)
    {
        $commentRepository->create($commentStoreRequest);

        return back()->with('success', __('Comment Sent Successfully'));
    }
}
