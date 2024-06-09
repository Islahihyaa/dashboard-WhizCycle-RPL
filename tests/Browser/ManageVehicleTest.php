<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ManageVehicleTest extends DuskTestCase
{
    /**
     * @test
     * @group vehicle
     */
    public function admin_can_add_vehicle_with_valid_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-vehicles')
                    ->click('@add-vehicle')
                    ->waitForText('Tambah Kendaraan')
                    ->assertPathIs('/add-vehicles')
                    ->type('name_vehicle', 'Kendaraan A')
                    ->select('category_vehicle', 'Kendaraan Roda 3')
                    ->type('description_vehicle', 'PLAT D-1234-BF WARNA HITAM')
                    ->select('status_vehicle', 'Sudah Baik')
                    ->press('SUBMIT')
                    ->assertPathIs('/add-vehicles')
                    ->waitForText('Data Kendaraan Berhasil Ditambahkan');
        });
    }

    /**
     * @test
     * @group vehicle
     */
    public function admin_add_vehicle_with_invalid_name_data(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-vehicles')
                    ->click('@add-vehicle')
                    ->waitForText('Tambah Kendaraan')
                    ->assertPathIs('/add-vehicles')
                    ->type('name_vehicle', 'A')
                    ->select('category_vehicle', 'Kendaraan Roda 3')
                    ->type('description_vehicle', 'PLAT D-1234-BF WARNA HITAM')
                    ->select('status_vehicle', 'Sudah Baik')
                    ->press('SUBMIT')
                    ->assertPathIs('/add-vehicles')
                    ->waitForText('The name vehicle field must be at least 5 characters.');
        });
    }

    /**
     * @test
     * @group vehicle
     */
    public function admin_can_update_status_vehicle(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/manage-vehicles')
                    ->assertSee('Data Kendaraan')
                    ->click('@dropdown-toggle')
                    ->waitFor('@status-option-sudah-baik')
                    ->click('@status-option-sudah-baik')
                    ->assertSee('Data berhasil diubah menjadi Sudah Baik');
        });
    }
}
