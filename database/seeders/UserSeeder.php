<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '01234',
                'address' => 'Yes',
                'password' => Hash::make('admin@admin.com'),
                'role' => "Admin",
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@customer.com',
                'phone' => '01234',
                'address' => 'Yes',
                'password' => Hash::make('customer@customer.com'),
                'role' => "Customer",
            ],
        ]);
    }
}
