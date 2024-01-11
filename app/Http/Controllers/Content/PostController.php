<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Content/CreatePost');
    }

    public function show(string $id, PostRepository $postRepository)
    {
        $post = $postRepository->getById($id);

        return Inertia::render('Content/ShowPost', [
            'post' => new PostResource($post)
        ]);
    }

    public function store(PostStoreRequest $postStoreRequest, PostRepository $postRepository): RedirectResponse
    {
        $postRepository->create($postStoreRequest);

        return redirect()
            ->route('home')
            ->with('success', __('Post created successfully!'));
    }

}
