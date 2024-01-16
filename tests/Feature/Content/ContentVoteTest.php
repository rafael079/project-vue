<?php

namespace Tests\Feature\Content;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContentVoteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_vote_up_content(): void
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('v1.posts.vote.store'), [
            'post_id' => $post->id,
            'vote' => 'up',
            'current' => null,
        ]);

        $result = $response->decodeResponseJson();

        $response->assertStatus(201);

        $this->assertTrue($result['data']['is_up_vote']);
        $this->assertFalse($result['data']['is_down_vote']);

    }

    public function test_user_can_vote_down_content(): void
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('v1.posts.vote.store'), [
            'post_id' => $post->id,
            'vote' => 'down',
            'current' => null,
        ]);

        $result = $response->decodeResponseJson();

        $response->assertStatus(201);

        $this->assertFalse($result['data']['is_up_vote']);
        $this->assertTrue($result['data']['is_down_vote']);

    }

    public function test_user_can_cancel_vote_content(): void
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('v1.posts.vote.store'), [
            'post_id' => $post->id,
            'vote' => 'down',
            'current' => null,
        ]);

        $result = $response->decodeResponseJson();

        $this->assertFalse($result['data']['is_up_vote']);
        $this->assertTrue($result['data']['is_down_vote']);

        $response->assertStatus(201);

        $responseCancel = $this->actingAs($user)->post(route('v1.posts.vote.store'), [
            'post_id' => $post->id,
            'vote' => 'down',
            'current' => 'down',
        ]);

        $responseCancel->assertStatus(200);
    }
}
