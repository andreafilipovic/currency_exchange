<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\CurrencySurcharge;
use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySurchargesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $currency_from = Currency::where('short_name','USD')->first();
        $status_type = StatusType::where('name','Surcharge')->first();
        $status = Status::where(['status_type_id' => $status_type->id, 'name' => 'active'])->first();
        $currency_surcharges = [
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','JPY')->first()->id,
                'status_id' => $status->id,
                'amount' => 7.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','GBP')->first()->id,
                'status_id' => $status->id,
                'amount' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','EUR')->first()->id,
                'status_id' => $status->id,
                'amount' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        CurrencySurcharge::insert($currency_surcharges);
    }
}
