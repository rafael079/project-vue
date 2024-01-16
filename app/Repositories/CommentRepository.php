<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Services\Util\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    public function create(Request $request): Comment
    {
        return Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id,
            'comment_id' => $request->parent_comment_id,
            'message' => $request->message
        ]);
    }

    public function getByPostId(string $post_id): Collection
    {
        $post_id = (new HashIdService())->decode($post_id);

        return Comment::with(['user', 'replies' => fn($query) => $query->orderBy('created_at', 'DESC')])->root()->latest()->where(['post_id' => $post_id])->get();
    }
}