<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Driver;

class ManageDriverTest extends DuskTestCase
{

    /**
     * @test
     * @group driver
     */
    public function admin_can_add_driver_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-driver')
                    ->click('@add-driver')
                    ->waitForText('Tambah Driver')
                    ->type('name_driver', 'Driver 2')
                    ->type('phoneNo_driver', '1234567890')
                    ->type('license_number', 'ABCD12345')
                    ->attach('image_driver', __DIR__.'/files/photo_driver.jpg')
                    ->select('vehicle_id', 'Kendaraan A')
                    ->press('SUBMIT')
                    ->assertPathIs('/add-driver')
                    ->assertSee('Data Driver Berhasil Ditambahkan');
        });
    }

    /**
     * @test
     * @group driver
     */
    public function admin_can_add_driver_with_invalid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-driver')
                    ->click('@add-driver')
                    ->waitForText('Tambah Driver')
                    ->type('name_driver', 'Driver 1')
                    ->type('phoneNo_driver', '1234567890')
                    ->type('license_number', 'A12345AA')
                    ->attach('image_driver', __DIR__.'/files/photo_driver.jpg')
                    ->select('vehicle_id', '8')
                    ->press('SUBMIT')
                    ->assertPathIs('/add-driver')
                    ->assertSee('The license number has already been taken.');
        });
    }

    /**
     * @test
     * @group driver
     */
    public function admin_can_read_data_driver(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-driver')
                    ->waitForText('Tambah Driver')
                    ->assertSee('Driver 1')
                    ->assertSee('1234567890')
                    ->assertSee('BB12345')
                    ->assertSee('Kendaraan A');
        });
    }

    /**
     * @test
     * @group driver
     *
     */
    public function admin_can_update_data_driver(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-driver')
                    ->click('@update-driver')
                    ->waitForText('Ubah Data Driver')
                    ->attach('image_driver', __DIR__.'/files/photo_driver_new.jpeg')
                    ->type('name_driver', 'New Driver 1')
                    ->type('phoneNo_driver', '1234567')
                    ->type('license_number', 'NEWAB123456')
                    ->select('vehicle_id', 'Kendaraan B')
                    ->press('SUBMIT')
                    ->assertSee('Data berhasil diubah');
        });
    }

    /**
     * @test
     * @group driver
     */
    public function admin_can_delete_data_driver(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-driver')
                    ->click('@delete-driver')
                    ->pause(1000);

            $browser->waitForText('Konfirmasi Hapus Data')
                    ->press('Hapus')
                    ->pause(1000);

            $browser->assertSee('Data berhasil dihapus');
        });
    }
}
