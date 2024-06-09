<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class readHistoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            // Visit the home page and assert 'Home' text is present
            $browser->visit('/')
                    ->assertSee('WhizCycle!')
                    ->clickLink('Login')
                    ->assertPathIs('/login')
                    ->type('name', 'nazwa')
                    ->type('password', '1234')
                    ->press('Masuk')
                    ->assertPathIs('/home')
                    ->visit('/riwayat');
        });
    }
}
