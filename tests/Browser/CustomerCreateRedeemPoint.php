<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CustomerCreateRedeemPoint extends DuskTestCase
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
                    ->type('name', 'wilwil')
                    ->type('password', 'user2403')
                    ->screenshot('before_submit_login') // Mengambil screenshot sebelum login
                    ->press('Masuk')
                    ->assertPathIs('/home')
                    ->clickLink('Tukar Point')
                    ->assertPathIs('/redeem-point')
                    ->click('#main-reedem > div > div > div.col-md-12 > div > div:nth-child(1)')
                    ->waitForText('Redeem Point Confirmation')
                    ->press('Redeem')
                    ->screenshot('final'); // Mengambil screenshot pada akhir proses
        });
    }
}
