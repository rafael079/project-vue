<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\VoteStoreRequest;
use App\Repositories\VoteRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(VoteStoreRequest $voteStoreRequest, VoteRepository $voteRepository)
    {
        return $voteRepository->create($voteStoreRequest);
    }
}
