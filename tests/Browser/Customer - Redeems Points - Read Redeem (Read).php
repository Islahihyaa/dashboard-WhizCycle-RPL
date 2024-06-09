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
            $browser->visit('/')
                    ->assertSee('WhizCycle!')
                    ->clickLink('Daftar')
                    ->assertPathIs('/register')
                    ->pause(1000) // Menambahkan jeda untuk memastikan halaman sudah selesai dimuat
                    ->type('name','william')
                    ->type('address','pbb c115')
                    ->type('phoneNo','0812345654')
                    ->type('password','4321')
                    ->screenshot('before_submit_register') // Mengambil screenshot sebelum submit
                    ->press('Daftar')
                    ->assertPathIs('/login')
                    ->type('name', 'william')
                    ->type('password', '4321')
                    ->screenshot('before_submit_login') // Mengambil screenshot sebelum login
                    ->press('Masuk')
                    ->assertPathIs('/home')
                    ->clickLink('Tukar Point')
                    ->assertPathIs('/redeem-point')
                    ->screenshot('final'); // Mengambil screenshot pada akhir proses
        });

    }
}
