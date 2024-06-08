<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register') // Change this to the actual registration page URL
                    ->assertSee('Register') // Change this to the text indicating the registration page
                    ->type('name', 'nazwa') // Change 'name' to the actual input field name for name
                    ->type('password', '1234') // Change 'password' to the actual input field name for password
                    ->press('Register') // Change 'Register' to the actual button text for registration
                    ->assertPathIs('/dashboard'); // Change '/dashboard' to the actual path where the customer is redirected after registration
        });
    }
}
