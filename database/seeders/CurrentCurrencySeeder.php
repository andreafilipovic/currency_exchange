<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\CurrentCurrency;
use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrentCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $status_type = StatusType::where('name','Current currency')->first();
        $status = Status::where([
            'status_type_id' => $status_type->id,
            'name' => 'active'
        ])->first();
        $current_currency = [
            [
                'currency_id' => Currency::where('name','United States Dollar')->first()->id,
                'status_id' => $status->id,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        CurrentCurrency::insert($current_currency);
        
    }
}
