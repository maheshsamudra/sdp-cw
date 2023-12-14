<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ComplaintImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "General Public",
            'email' => 'user@techtitans.com',
            'nic' => '199010301234',
            'dob' => '1990/04/12'
        ]);
    }
}
