<?php

namespace Tests\Feature;

use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_index_can_be_accessed(): void
    {
        $response = $this->get(route('guests.index'));
        $response->assertStatus(200);
    }

    public function test_guest_index_shows_guests(): void
    {
        Guest::factory()->count(3)->create();
        $response = $this->get(route('guests.index'));
        $response->assertStatus(200);
    }

    public function test_guest_index_search_by_name(): void
    {
        Guest::factory()->create(['name' => 'Budi Santoso']);
        $response = $this->get(route('guests.index', ['search' => 'Budi']));
        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
    }

    public function test_guest_index_search_by_email(): void
    {
        Guest::factory()->create(['email' => 'budi@example.com']);
        $response = $this->get(route('guests.index', ['search' => 'budi@example.com']));
        $response->assertStatus(200);
    }

    public function test_guest_index_search_by_company(): void
    {
        Guest::factory()->create(['company' => 'PT Maju Jaya']);
        $response = $this->get(route('guests.index', ['search' => 'Maju']));
        $response->assertStatus(200);
    }

    public function test_guest_index_search_by_ucapan(): void
    {
        Guest::factory()->create(['ucapan' => 'Selamat dan sukses']);
        $response = $this->get(route('guests.index', ['search' => 'sukses']));
        $response->assertStatus(200);
    }

    public function test_guest_index_invalid_page_returns_404(): void
    {
        $response = $this->get(route('guests.index', ['page' => 9999]));
        $response->assertStatus(404);
    }

    public function test_guest_create_page_can_be_accessed(): void
    {
        $response = $this->get(route('guests.create'));
        $response->assertStatus(200);
    }

    public function test_guest_can_be_stored(): void
    {
        $data = [
            'name'    => 'Tiara Aulia',
            'email'   => 'tiara@example.com',
            'company' => 'PT Test',
            'ucapan'  => 'Selamat sukses selalu!',
        ];

        $response = $this->post(route('guests.store'), $data);
        $response->assertRedirect(route('guests.index'));
        $this->assertDatabaseHas('guests', ['email' => 'tiara@example.com']);
    }

    public function test_guest_store_fails_without_name(): void
    {
        $data = [
            'email'   => 'tiara@example.com',
            'company' => 'PT Test',
            'ucapan'  => 'Selamat!',
        ];

        $response = $this->post(route('guests.store'), $data);
        $response->assertSessionHasErrors('name');
    }

    public function test_guest_store_fails_without_email(): void
    {
        $data = [
            'name'    => 'Tiara',
            'company' => 'PT Test',
            'ucapan'  => 'Selamat!',
        ];

        $response = $this->post(route('guests.store'), $data);
        $response->assertSessionHasErrors('email');
    }

    public function test_guest_show_can_be_accessed(): void
    {
        $guest = Guest::factory()->create();
        $response = $this->get(route('guests.show', $guest));
        $response->assertStatus(200);
    }

    public function test_guest_edit_page_can_be_accessed(): void
    {
        $guest = Guest::factory()->create();
        $response = $this->get(route('guests.edit', $guest));
        $response->assertStatus(200);
    }

    public function test_guest_can_be_updated(): void
    {
        $guest = Guest::factory()->create();

        $data = [
            'name'    => 'Nama Baru',
            'email'   => 'baru@example.com',
            'company' => 'PT Baru',
            'ucapan'  => 'Ucapan baru!',
        ];

        $response = $this->put(route('guests.update', $guest), $data);
        $response->assertRedirect(route('guests.index'));
        $this->assertDatabaseHas('guests', ['name' => 'Nama Baru']);
    }

    public function test_guest_update_fails_without_name(): void
    {
        $guest = Guest::factory()->create();

        $data = [
            'email'   => 'baru@example.com',
            'company' => 'PT Baru',
            'ucapan'  => 'Ucapan baru!',
        ];

        $response = $this->put(route('guests.update', $guest), $data);
        $response->assertSessionHasErrors('name');
    }

    public function test_guest_can_be_deleted(): void
    {
        $guest = Guest::factory()->create();
        $response = $this->delete(route('guests.destroy', $guest));
        $response->assertRedirect(route('guests.index'));
        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }
}