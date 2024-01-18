<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use App\Services\Content\UploadFilesContent;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Content/CreatePost');
    }

    public function show(string $id, PostRepository $repository)
    {
        $post = $repository->getById($id);

        return Inertia::render('Content/ShowPost', [
            'post' => new PostResource($post)
        ]);
    }

    public function store(PostStoreRequest $request, PostRepository $repository, UploadFilesContent $uploadService): RedirectResponse
    {
        $post = $repository->create($request);

        if (!empty($request->urlImages)) {
            $uploadService->uploadByUrl($request->urlImages, $post);
        }

        if ($post && ($request->images || $request->videos)) {
            $uploadService->upload(($request->images ?? $request->videos), $post);
        }

        return redirect()
            ->route('home')
            ->with('success', __('Post created successfully!'));
    }

}
