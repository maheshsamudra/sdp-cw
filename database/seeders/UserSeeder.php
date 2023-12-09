<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Manager",
            'email' => 'manager@techtitans.com',
            'password' => Hash::make('Welcome@1234'),
            'role' => 'manager'
        ]);

        DB::table('users')->insert([
            'name' => "Staff Member",
            'email' => 'staff@techtitans.com',
            'password' => Hash::make('Welcome@1234'),
            'role' => 'staff'
        ]);

        DB::table('users')->insert([
            'name' => "Staff Member",
            'email' => 'user@techtitans.com',
            'password' => Hash::make('Welcome@1234'),
            'nic' => '199010301234',
            'dob' => '1990/04/12'
        ]);
    }
}
