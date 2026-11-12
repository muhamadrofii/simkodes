<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class InventoryPage extends Page
{
    public function url(): string
    {
        return '/inventories';
    }

    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url())
                ->assertSee('Buku Inventaris');
    }
}
