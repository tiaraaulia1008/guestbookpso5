<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestRegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_can_be_accessed(): void
    {
        $response = $this->get(route('registration.create'));
        $response->assertStatus(200);
    }

    public function test_guest_registration_can_be_stored_without_photo(): void
    {
        $data = [
            'name'    => 'Tiara',
            'email'   => 'tiara@example.com',
            'company' => 'PT Test',
            'message' => 'Selamat dan sukses!',
        ];

        $response = $this->post(route('registration.store'), $data);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('guest', ['name' => 'Tiara']);
    }

    public function test_registration_fails_without_name(): void
    {
        $data = [
            'message' => 'Selamat!',
        ];

        $response = $this->post(route('registration.store'), $data);
        $response->assertSessionHasErrors('name');
    }

    public function test_registration_fails_without_message(): void
    {
        $data = [
            'name' => 'Tiara',
        ];

        $response = $this->post(route('registration.store'), $data);
        $response->assertSessionHasErrors('message');
    }
}