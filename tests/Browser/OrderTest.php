<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class OrderTest extends DuskTestCase
{
    /**
     * @test
     * @group order
     */
    public function user_can_submit_order_form_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/order')
                    ->waitFor('#inputName', 30)
                    ->type('name', 'Islahihya')
                    ->type('phoneNo', '08885')
                    ->type('address', 'Bandung')
                    ->type('pickup_date', '15-08-2024')
                    ->waitFor('#inputTime', 30)
                    ->type('pickup_time', '02:14:00')
                    ->select('category_trash', 'Organik')
                    ->type('amount', '5')
                    ->type('notes', 'Please handle with care')
                    ->attach('file_payment', __DIR__.'/files/payment_receipt.jpg')
                    ->press('SUBMIT')
                    ->waitForText('Konfirmasi Penjemputan Sampah')
                    ->press('PESAN SEKARANG')
                    ->assertPathIs('/success-payment')
                    ->assertSee('Pembayaran Anda Berhasil');
        });
    }

    /**
     * @test
     * @group order
     */
    public function user_submit_order_form_with_invalid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/order')
                    ->waitFor('#inputName', 30)
                    ->type('name', 'Islahihya')
                    ->type('phoneNo', '08885')
                    ->type('address', 'Bandung')
                    ->type('pickup_date', '15-08-2024')
                    ->press('SUBMIT')
                    ->waitForText('Konfirmasi Penjemputan Sampah')
                    ->press('PESAN SEKARANG')
                    ->pause(1000)
                    ->assertPathIs('/order');
        });
    }
}
