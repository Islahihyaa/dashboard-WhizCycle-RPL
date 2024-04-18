<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'alfi_superadmin', 
            'email' => 'alfi@superadmin.com',
            'password' => Hash::make('alfisuperadmin')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'alfi_admin', 
            'email' => 'alfi@admin.com',
            'password' => Hash::make('alfiadmin')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'alfi_pm', 
            'email' => 'alfi@pm.com',
            'password' => Hash::make('alfiproductmanager')
        ]);
        $productManager->assignRole('Product Manager');
    }
}