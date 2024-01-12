<?php

namespace App\Repositories;

use App\Contracts\Repository\PostRepositoryInterface;
use App\Services\Util\HashIdService;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
use Illuminate\Http\Request;
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

        return $post;

    }

    public function getAllPostsPublished(): Collection
    {
        $posts = Post::latest()->published()->get();
        return $posts;
    }
}