<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $status_type = StatusType::where('name','Currency')->first();
        $status = Status::where(['status_type_id' => $status_type->id, 'name' => 'active'])->first();
        $currencies = [
            [
                'name' => 'Japanese Yen',
                'short_name' => 'JPY',
                'status_id' => $status->id,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'British Pound',
                'short_name' => 'GBP',
                'status_id' => $status->id,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Euro',
                'short_name' => 'EUR',
                'status_id' => $status->id,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'United States Dollar',
                'short_name' => 'USD',
                'status_id' => $status->id,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        Currency::insert($currencies);
    }
}
