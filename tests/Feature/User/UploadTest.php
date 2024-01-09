<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_upload_cover(): void
    {
        $storage = Storage::fake(config('uploads.disk'));

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('cover.jpg');

        $this->actingAs($user)->post(route('users.profile.upload.cover'), [
            'cover' => $file
        ]);

        $findUser = User::find($user->id);

        $storage->assertExists("users/cover/{$findUser->cover}");
    }
}
