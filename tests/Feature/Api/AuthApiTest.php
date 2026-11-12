<?php

namespace Tests\Feature\Api;

class AuthApiTest extends ApiTestCase
{
    /**
     * Memastikan request tanpa Bearer Token ditolak dengan HTTP 401 Unauthorized
     */
    public function test_unauthenticated_request_is_rejected(): void
    {
        $response = $this->apiGet('/api/members');
        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.'
                 ]);
    }

    /**
     * Memastikan login gagal jika kredensial tidak sesuai
     */
    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->apiPost('/api/login', [
            'email' => 'admin@wrong.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => 'error',
                 ]);
    }

    /**
     * Memastikan login sukses menghasilkan Bearer Token standar Sanctum
     */
    public function test_login_success_returns_bearer_token(): void
    {
        $response = $this->apiPost('/api/login', [
            'email' => $this->user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'data' => [
                         'token',
                         'token_type',
                         'user' => ['id', 'name', 'email'],
                     ],
                 ]);

        $this->assertEquals('Bearer', $response->json('data.token_type'));
    }

    /**
     * Memastikan endpoint /api/me mengembalikan profil user yang sedang login
     */
    public function test_me_endpoint_returns_current_user(): void
    {
        $response = $this->apiAs()->apiGet('/api/me');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'data' => [
                         'email' => $this->user->email,
                     ],
                 ]);
    }

    /**
     * Memastikan logout berhasil mencabut token aktif
     */
    public function test_logout_revokes_token(): void
    {
        $tokenObj = $this->user->createToken('test-logout-token');
        $plainToken = $tokenObj->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $plainToken)
                         ->apiPost('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Token berhasil dicabut, Anda telah logout.',
                 ]);

        $this->assertNull(\Laravel\Sanctum\PersonalAccessToken::findToken($plainToken));
    }
}
