<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateLaporanRiwayatTukarPoint extends DuskTestCase
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
                    ->type('name', 'Admin')
                    ->type('password', '123123')
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->clickLink('Laporan') // Navigates to the laporan page
                    ->assertPathIs('/laporan')
                    ->clickLink('Data Tukar Point') // Clicks the 'Data Tukar Point' link/button
                    ->assertPathIs('/data-point')
                    ->press('#exportButton'); // Presses the export button by its ID
        });
    }
}
