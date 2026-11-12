<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class MemberPage extends Page
{
    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/members';
    }

    /**
     * Assert that the browser is on the page.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url())
                ->assertSee('Data Anggota');
    }

    /**
     * Method OOP: Buka form tambah dan simpan anggota baru.
     */
    public function createMember(Browser $browser, array $data): void
    {
        $browser->visit('/members/create')
                ->select('category_id', $data['category_id'] ?? '1')
                ->type('nama', $data['nama'])
                ->press('Simpan');
    }

    /**
     * Method OOP: Verifikasi nama anggota ada di dalam tabel.
     */
    public function assertMemberInList(Browser $browser, string $name): void
    {
        $browser->assertSeeIn('table', $name);
    }
}
