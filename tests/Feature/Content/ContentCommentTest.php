<?php

namespace Tests\Feature\Content;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\Util\HashIdService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContentCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_comment(): void
    {
        $user = User::all()->random();

        $post = Post::all()->random();

        $response = $this->actingAs($user)->post(route('posts.comments.store'), [
            'message' => fake()->realText(100),
            'post_id' => $post->id
        ]);

        $response->assertRedirect();
        $response->assertStatus(302);
    }


    public function test_user_can_respond_comment(): void
    {
        $comment = Comment::all()->random();

        $user = User::find($comment->user_id);

        $response = $this->actingAs($user)->post(route('posts.comments.store'), [
            'message' => fake()->realText(100),
            'post_id' => $comment->post_id,
            'parent_comment_id' => $comment->id
        ]);

        $response->assertRedirect();
        $response->assertStatus(302);
    }
}
