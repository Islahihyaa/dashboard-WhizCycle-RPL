<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * @test
     * @group register
     */
    public function user_can_register_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->type('name', 'admin')
            ->type('address', 'Bandung')
            ->type('phoneNo', '08885')
            ->type('password', 'admin123')
            ->press('Daftar')
            ->assertPathIs('/login')
            ->assertSee('Register Success');
            });
    }
            
    /**
     * @test
     * @group register
     */
    public function user_register_with_invalid_credentials(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Islahihya')
                    ->type('address', 'Bandung')
                    ->type('phoneNo', '088')
                    ->type('password', '12')
                    ->press('Daftar')
                    ->assertPathIs('/register')
                    ->assertSee('The phone no field must be at least 5 characters.')
                    ->assertSee('The password field must be at least 3 characters.');
        });
    }
}
