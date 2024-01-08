<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_view_home_page(): void
    {
        $response = $this->get('/')->assertInertia(fn(Assert $page) => $page->component('Home/HomePage'));

        $response->assertStatus(200);
    }
}
