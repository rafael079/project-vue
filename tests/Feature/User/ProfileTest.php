<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * User page
     */
    public function test_user_page_can_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/u/" . $user->username)
            ->assertInertia(fn(Assert $page) => $page
                ->component('User/ProfileShow'));

        $response->assertOk();
    }

    /**
     * User update
     */
    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'username' => fake()->userName(),
        ];

        $response = $this
            ->actingAs($user)
            ->patch(route('users.profile.update'), [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect("/u/" . $data['username']);

        $user->refresh();

        $this->assertSame($data['first_name'], $user->first_name);
        $this->assertSame($data['last_name'], $user->last_name);
        $this->assertSame($data['username'], $user->username);
    }

}
