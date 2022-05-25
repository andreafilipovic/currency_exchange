<?php

namespace App\Console\Commands;

use App\Models\CurrencyExchangeRate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateCurrencyExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_exchange_rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $request = $client->get(env('EXCHANGE_RATES_API_AND_KEY'));
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $currency_exchange_rate = new CurrencyExchangeRate();
        $currency_exchange_rate = $currency_exchange_rate->updateExchangeRates($data);
    }
}
