<?php

namespace App\Repositories;

use App\Contracts\Repository\PostRepositoryInterface;
use App\Models\Category;
use App\Services\Util\HashIdService;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @param \App\Http\Requests\Content\PostStoreRequest $request
     * 
     * @return Post
     */
    public function create(Request $request): Post
    {
        return $request->user()->posts()->create([
            'slug' => Str::words(Str::slug($request->title), 22),
            'title' => $request->title,
            'category_id' => $request->category,
            'content' => $request->content,
            'excerpt' => $request->content ? strip_tags($request->content) : null,
            'source' => $request->url,
            'imported' => isset($request->url),
        ]);
    }

    public function getById(string $id): Post
    {
        $id = (new HashIdService)->decode($id);

        $post = Post::where(['id' => $id])->first();

        if (Auth::check()) {
            $post = Auth::user()->attachVoteStatus($post);
        }

        return $post;

    }

    public function getAllPostsPublished(array $params = null): Collection
    {
        $posts = Post::latest()->published();

        if (isset($params['category'])) {
            $posts = $posts->where('category_id', $params['category']);
        }

        $posts = $posts->get();

        if (Auth::check()) {
            $posts = Auth::user()->attachVoteStatus($posts);
        }

        return $posts;
    }
}