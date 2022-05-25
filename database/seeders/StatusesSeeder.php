<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $curency = StatusType::where('name','Currency')->first();
        $current = StatusType::where('name','Current currency')->first();
        $discount = StatusType::where('name','Discount')->first();
        $surcharge = StatusType::where('name','Surcharge')->first();

        $statuses = [
            [
                'status_type_id' => $curency->id,
                'name' => 'active',
                'title' => 'Active',
                'parent_status' => 'Active',
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status_type_id' => $curency->id,
                'name' => 'inactive',
                'title' => 'Inactive',
                'parent_status' => 'Inactive',
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status_type_id' => $current->id,
                'name' => 'active',
                'title' => 'Active',
                'parent_status' => 'Active',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_type_id' => $current->id,
                'name' => 'inactive',
                'title' => 'Inactive',
                'parent_status' => 'Inactive',
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status_type_id' => $surcharge->id,
                'name' => 'active',
                'title' => 'Active',
                'parent_status' => 'Active',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_type_id' => $surcharge->id,
                'name' => 'inactive',
                'title' => 'Inactive',
                'parent_status' => 'Inactive',
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'status_type_id' => $discount->id,
                'name' => 'active',
                'title' => 'Active',
                'parent_status' => 'Active',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status_type_id' => $discount->id,
                'name' => 'inactive',
                'title' => 'Inactive',
                'parent_status' => 'Inactive',
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        Status::insert($statuses);
    }
}