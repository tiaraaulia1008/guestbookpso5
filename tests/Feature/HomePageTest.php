<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_can_be_accessed(): void
    {
        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
    }

    public function test_homepage_search_can_be_accessed(): void
    {
        $response = $this->get('/?search=Tiara');

        $response->assertStatus(200);
    }

    public function test_invalid_page_returns_404(): void
    {
        $response = $this->get('/?page=999');

        $response->assertStatus(404);
    }
}