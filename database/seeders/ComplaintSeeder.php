<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 10; $i++) {
            $assigned = null;
            if ($i < 2) {
                $assigned = 1;
            } else if ($i < 5) {
                $assigned = 2;
            }
            DB::table('complaints')->insert([
                'department_id' => 1,
                'user_id' => 4,
                'assigned_staff_user_id' =>  $assigned,
                'title' => 'Test complaint ' . $i + 1,
                'observed_date' => '2023-10-' . $i + 1,
                'details' => 'Test complaint details',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
