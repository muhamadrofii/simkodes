<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\LoginPage;

class AuthTest extends DuskTestCase
{
    public function test_guest_sees_login_form(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage)
                    ->assertSee('Masuk ke SIMKODES');
        });
    }

    public function test_user_can_login_via_dusk(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            if ($user) {
                $browser->visit(new LoginPage)
                        ->type('email', $user->email)
                        ->type('password', 'password123')
                        ->press('Masuk')
                        ->assertPathIs('/dashboard');
            }
        });
    }
}
