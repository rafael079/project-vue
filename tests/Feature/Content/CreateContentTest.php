<?php

namespace Tests\Feature\Content;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateContentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_content(): void
    {
        $user = User::factory()->create();

        $data = [
            'slug' => Str::words(Str::slug(fake()->text(190)), 22),
            'title' => fake()->text(190),
            'content' => fake()->text(),
            'excerpt' => fake()->text(),
            'source' => fake()->url(),
            'imported' => true,
        ];

        $response = $this
            ->actingAs($user)->post(route('posts.store'), [
                    'slug' => $data['slug'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'excerpt' => $data['excerpt'],
                    'source' => $data['source'],
                    'imported' => true,
                ]);

        $response->assertRedirect(route('home'));
    }
}
