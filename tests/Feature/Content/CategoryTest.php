<?php

namespace Tests\Feature\Content;

use App\Models\Category;
use App\Services\Util\HashIdService;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_view_category_page(): void
    {
        $category = Category::factory()->create();

        $category_id = (new HashIdService())->encode($category->id);

        $response = $this->get("/c/{$category_id}/{$category->name}")
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Category/CategoryShow')
            );

        $response->assertOk();
    }
}
