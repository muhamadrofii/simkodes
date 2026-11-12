<?php

namespace Tests\Feature;

use App\Models\User;

class AuthTest extends SimkodesTestCase
{
    /**
     * Memastikan landing page publik dapat diakses tanpa login.
     */
    public function test_landing_page_accessible_by_guest(): void
    {
        $this->get('/')->assertStatus(200);
    }

    /**
     * Memastikan halaman profil/tentang dapat diakses oleh user yang terautentikasi.
     */
    public function test_about_page_accessible_by_authenticated_user(): void
    {
        $this->authGet('/about')->assertStatus(200);
    }

    /**
     * Memastikan pengunjung (guest) tidak bisa mengakses dashboard tanpa login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    /**
     * Memastikan form login dapat dimuat dengan baik.
     */
    public function test_login_page_renders_successfully(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    /**
     * Memastikan pengguna dapat login menggunakan kredensial yang valid.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'auth_test_' . time() . '@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Memastikan pengguna yang sudah terotentikasi dapat mengakses dashboard.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $this->authGet('/dashboard')->assertStatus(200);
    }
}
