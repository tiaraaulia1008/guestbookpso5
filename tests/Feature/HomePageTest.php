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
}