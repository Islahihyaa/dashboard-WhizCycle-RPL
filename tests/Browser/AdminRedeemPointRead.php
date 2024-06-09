<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminRedeemPointRead extends DuskTestCase
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
                    ->pause(1000) // Menambahkan jeda untuk memastikan halaman sudah selesai dimuat
                    ->type('name','williamuser')
                    ->type('password','user123')
                    ->screenshot('before_submit_register') // Mengambil screenshot sebelum submit
                    ->press('Masuk')
                    ->assertPathIs('/dashboard')
                    ->clickLink('Riwayat Tukar Point')
                    ->assertPathIs('/history-all-redeem-point')
                    ->screenshot('final'); // Mengambil screenshot pada akhir proses


        });
    }
}
