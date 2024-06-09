<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCreateInputDataVoucher extends DuskTestCase
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
                    ->clickLink('Data Voucher')
                    ->assertPathIs('/voucher')
                    ->press('Add Voucher')
                    ->whenAvailable('.modal', function ($modal) {
                    // Isi form di dalam pop-up
            $modal->type('voucher', 'Circle K Rp. 250,000')
                      ->type('point', '250')
                      ->screenshot('before_submit_modal') // Screenshot sebelum submit pop-up
                      ->press('Submit');
            })
            ->screenshot('final'); // Screenshot hasil akhir

        });
    }
}
