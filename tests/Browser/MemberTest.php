<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\MemberPage;

class MemberTest extends DuskTestCase
{
    /**
     * Skenario: Pengguna login dan menavigasi modul anggota.
     */
    public function test_user_can_access_login_and_navigate_members(): void
    {
        $this->browse(function (Browser $browser) {
            // 1. Kunjungi halaman Login via Page Object
            $browser->visit(new LoginPage)
                    ->assertSee('Masuk ke SIMKODES');

            // 2. Ambil user pertama atau login manual
            $user = User::first();
            if ($user) {
                $browser->loginAs($user)
                        ->visit('/dashboard')
                        ->assertSee('Dashboard');

                // 3. Masuk ke halaman anggota via Page Object
                $browser->visit(new MemberPage)
                        ->assertSee('Data Anggota')
                        ->screenshot('halaman_anggota_dusk');
            }
        });
    }
}

