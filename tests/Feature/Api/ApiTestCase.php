<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Base TestCase untuk seluruh pengujian RESTful API SIMKODES.
 * Menerapkan standar HTTP JSON API & Sanctum Token Authentication.
 */
abstract class ApiTestCase extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::firstOrCreate(
            ['email' => 'api_admin@test.com'],
            ['name' => 'API Admin Tester', 'password' => bcrypt('password123')]
        );
    }

    /**
     * Request JSON dengan token autentikasi Sanctum
     */
    protected function apiAs(User $user = null): static
    {
        Sanctum::actingAs($user ?? $this->user, ['*']);
        return $this;
    }

    /**
     * Request API dengan header standar Accept: application/json
     */
    protected function apiGet(string $uri, array $headers = [])
    {
        return $this->getJson($uri, array_merge(['Accept' => 'application/json'], $headers));
    }

    protected function apiPost(string $uri, array $data = [], array $headers = [])
    {
        return $this->postJson($uri, $data, array_merge(['Accept' => 'application/json'], $headers));
    }

    protected function apiPut(string $uri, array $data = [], array $headers = [])
    {
        return $this->putJson($uri, $data, array_merge(['Accept' => 'application/json'], $headers));
    }

    protected function apiDelete(string $uri, array $data = [], array $headers = [])
    {
        return $this->deleteJson($uri, $data, array_merge(['Accept' => 'application/json'], $headers));
    }
}
