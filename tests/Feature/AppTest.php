<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * Tests for Projects.
     */
    public function test_home_works(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_login_works() : void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_register_works() : void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    public function test_list_projects_works() : void
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }
    public function test_project_by_id_works() : void
    {
        $response = $this->get('/projects/1');
        $response->assertStatus(200);
    }
    public function test_auth_block_create_project_works() : void
    {
        $response = $this->get('/projects/create');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
    public function test_auth_block_project_by_id_works() : void
    {
        $response = $this->get('/projects/edit/1');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
    public function test_authorized_create_project_works() : void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/projects/create');
        $response->assertStatus(200);
    }
    public function test_authorized_project_by_id_works() : void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/projects/edit/1');
        $response->assertStatus(200);
    }
}
