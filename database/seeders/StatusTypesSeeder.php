<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $status_types = [
            [
                'name' => 'Currency',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Current currency',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Discount',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Surcharge',
                'created_at' => $now,
                'updated_at' => $now
            ],

        ];

        StatusType::insert($status_types);
    }
}
