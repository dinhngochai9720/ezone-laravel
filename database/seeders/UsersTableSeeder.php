<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Administrator',
                'fullname' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //Vendor
            [
                'name' => 'ExpressShopVendor',
                'fullname' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'vendor',
                'status' => 'active',
            ],

            //User
            [
                'name' => 'Dinh Ngoc Hai',
                'fullname' => 'User',
                'email' => 'dnhai9720@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);
    }
}
