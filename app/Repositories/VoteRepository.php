<?php

namespace App\Repositories;

use App\Http\Resources\VoteResource;
use App\Models\Post;
use Illuminate\Http\Request;

class VoteRepository
{
    public function create(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        if ($request->user()->hasVoted($post) && ($request->current === $request->vote)) {
            return $request->user()->cancelVote($post);
        } else {
            if ($request->vote === 'up') {
                return new VoteResource($request->user()->upvote($post));
            } elseif ($request->vote === 'down') {
                return new VoteResource($request->user()->downvote($post));
            }
        }
    }
}