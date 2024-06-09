<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteManajemenAkunTest extends DuskTestCase
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
                    ->clickLink('Management User') 
                    ->assertPathIs('/manageuser')
                    ->click('.bi-three-dots')
                    ->click('.dropdown-menu .btn-delete');
        });
    }
}
