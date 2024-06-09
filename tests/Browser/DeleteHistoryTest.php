<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteHistoryTest  extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('WhizCycle!')
                    ->clickLink('Login')
                    ->assertPathIs('/login')
                    ->type('name', 'nazwa')
                    ->type('password', '1234')
                    ->press('Masuk')
                    ->assertPathIs('/home')
                    ->visit('/riwayat')
                    ->press('Batalkan');
        });
    }
}
