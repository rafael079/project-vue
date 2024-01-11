<?php

namespace App\Services\Util;

use Hashids\Hashids;

class HashIdService
{
    /**
     * Hashids
     */
    private Hashids $hashService;

    public function __construct()
    {
        $this->hashService = new Hashids(config('app.key'), 10);
    }

    public function encode(int $id): string
    {
        return $this->hashService->encode($id);
    }

    public function decode(int|string $id): int
    {
        if (is_int($id)) {
            return $id;
        }

        return current($this->hashService->decode($id));
    }
}