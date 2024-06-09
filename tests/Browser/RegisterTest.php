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
            $browser->visit('/register') // Ganti ini dengan URL halaman registrasi aktual
                    ->assertSee('Register') // Ganti ini dengan teks yang menunjukkan halaman registrasi
                    ->type('name', 'nazwa') // Ganti 'name' dengan nama sebenarnya dari bidang input untuk nama
                    ->type('alamat', 'johar permai') // Ganti 'alamat' dengan nama sebenarnya dari bidang input untuk alamat
                    ->type('No.Telp', '08588343') // Ganti 'No.Telp' dengan nama sebenarnya dari bidang input untuk No. Telp
                    ->type('password', '1234') // Ganti 'password' dengan nama sebenarnya dari bidang input untuk password
                    ->press('Daftar') // Ganti 'Daftar' dengan teks tombol sebenarnya untuk registrasi
                    ->assertPathIs('/home'); // Ganti '/login' dengan jalur aktual di mana pelanggan diarahkan setelah registrasi berhasil
        });
    }
}
