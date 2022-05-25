<?php

namespace Tests\Feature\App;

use App\Models\Currency;
use App\Models\CurrencyExchangeRate;
use App\Models\CurrentCurrency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use SetupDataTrait;

    public function test_currency_info()
    {
        $currency = Currency::first();
        $current_currency = CurrentCurrency::first();
        
        $response = $this->get('/api/v1/app/currency_data_info/45');
        $response->assertStatus(404);

        $response = $this->get('/api/v1/app/currency_data_info/'.$currency->id);
        $response->assertStatus(200);

        $exchane_rate = CurrencyExchangeRate::where(['currency_from_id' => $current_currency->currency_id, 'currency_to_id' => $currency->id])->first();

        $this->assertEquals($exchane_rate->exchange_rate, $response->decodeResponseJson()['data']['currency_exchange_rate']);

        $response_stucture = [
            'data' => [
                'currency',
                'currency_exchange_rate',
                'currency_surcharge',
                'currency_discount'
            ],
            'message',
            'success'
        ];
        $response->assertJsonStructure($response_stucture);
    }
}
