<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateSetoranSampahTest extends DuskTestCase
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
                    ->type('name', 'admin')
                    ->type('password', '1234')
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->clickLink('Setoran Sampah')
                    ->assertPathIs('/manage-order')
                    ->clickLink('Detail');

        });
    }
}
