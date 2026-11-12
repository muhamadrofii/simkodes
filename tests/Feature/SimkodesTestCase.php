<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * Class SimkodesTestCase
 * Base class untuk seluruh pengujian fitur SIMKODES.
 * Menyediakan utilitas autentikasi & session handling berorientasi objek (OOP).
 */
abstract class SimkodesTestCase extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin Tester', 'password' => bcrypt('password123')]
        );
    }

    /**
     * Request GET dengan autentikasi & session aktif
     */
    protected function authGet(string $uri)
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->get($uri);
    }

    /**
     * Request POST dengan autentikasi & session aktif
     */
    protected function authPost(string $uri, array $data = [])
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->post($uri, $data);
    }

    /**
     * Request PUT dengan autentikasi & session aktif
     */
    protected function authPut(string $uri, array $data = [])
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->put($uri, $data);
    }

    /**
     * Request DELETE dengan autentikasi & session aktif
     */
    protected function authDelete(string $uri)
    {
        return $this->actingAs($this->user)
                    ->withSession(['last_activity' => time()])
                    ->delete($uri);
    }
}

