<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GuestRegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_can_be_accessed(): void
    {
        $response = $this->get(route('registration.create'));

        $response->assertStatus(200);
    }

    public function test_guest_registration_can_be_stored(): void
    {
        $response = $this->post(route('registration.store'), [
            'name' => 'Tiara',
            'email' => 'tiara@example.com',
            'company' => 'ITS',
            'message' => 'Semangat',
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('guest', [
            'name' => 'Tiara',
            'email' => 'tiara@example.com',
        ]);
    }

    public function test_guest_registration_can_be_stored_with_photo(): void
    {
        Http::fake();

        $response = $this->post(route('registration.store'), [
            'name' => 'Tiara',
            'email' => 'tiara@example.com',
            'company' => 'ITS',
            'message' => 'Semangat',
            'photo_data' => 'data:image/png;base64,' . base64_encode('fake-image'),
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('guest', [
            'email' => 'tiara@example.com',
        ]);
    }

    public function test_registration_fails_without_name(): void
    {
        $response = $this->post(route('registration.store'), [
            'email' => 'tiara@example.com',
            'company' => 'ITS',
            'message' => 'Semangat',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_registration_fails_without_email(): void
    {
        $response = $this->post(route('registration.store'), [
            'name' => 'Tiara',
            'company' => 'ITS',
            'message' => 'Semangat',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_registration_fails_without_company(): void
    {
        $response = $this->post(route('registration.store'), [
            'name' => 'Tiara',
            'email' => 'tiara@example.com',
            'message' => 'Semangat',
        ]);

        $response->assertSessionHasErrors('company');
    }

    public function test_registration_fails_without_message(): void
    {
        $response = $this->post(route('registration.store'), [
            'name' => 'Tiara',
            'email' => 'tiara@example.com',
            'company' => 'ITS',
        ]);

        $response->assertSessionHasErrors('message');
    }
}