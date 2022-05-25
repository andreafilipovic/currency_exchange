<?php

namespace Database\Seeders;

use App\Models\CurrencyDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTypesSeeder::class);
        $this->call(StatusesSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(CurrentCurrencySeeder::class);
        $this->call(CurrencyExchangeRatesSeeder::class);
        $this->call(CurrencySurchargesSeeder::class);
        $this->call(CurrencyDiscountsSeeder::class);
    }
}
