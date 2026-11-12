<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class DashboardPage extends Page
{
    public function url(): string
    {
        return '/dashboard';
    }

    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url())
                ->assertSee('Dashboard');
    }
}

