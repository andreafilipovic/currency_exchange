<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\CurrencyExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyExchangeRatesSeeder extends Seeder
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
        $currency_exchange_rates = [
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','JPY')->first()->id,
                'exchange_rate' => 107.17,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','GBP')->first()->id,
                'exchange_rate' => 0.711178,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'currency_from_id' => $currency_from->id,
                'currency_to_id' => Currency::where('short_name','EUR')->first()->id,
                'exchange_rate' => 0.884872,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        CurrencyExchangeRate::insert($currency_exchange_rates);
    }
}
