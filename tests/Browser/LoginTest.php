<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * @test
     * @group login
     */
    public function customer_can_login_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('name', 'Islahihya')
                    ->type('password', 'user123')
                    ->press('Masuk')
                    ->assertPathIs('/home')
                    ->assertSee('Beranda');

            $browser->logout();
        });

    }

    /**
     * @test
     * @group login
     */
    public function customer_login_with_invalid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('name', 'wrongusername')
                    ->type('password', 'wrongpassword')
                    ->press('Masuk')
                    ->assertPathIs('/login')
                    ->assertSee('Account not found');
            
            $browser->logout();
        });

    }

    /**
     * @test
     * @group login
     */
    public function admin_can_login_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('name', 'admin')
                    ->type('password', 'admin123')
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->assertSee('Beranda');

            $browser->logout();
        });

    }
}
