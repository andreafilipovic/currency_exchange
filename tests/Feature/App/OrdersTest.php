<?php

namespace Tests\Feature\App;

use App\Models\Currency;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use SetupDataTrait;

    public function test_create_order()
    {
        $data = [
            'email' => 'test@test.com',
            'currency_id' => Currency::first()->id
        ];
        $response = $this->post('/api/v1/app/order', $data);
        $response->assertStatus(422);

        $data = [
            'email' => 'test@test.com',
            'amount' => 200,
            'currency_id' => Currency::first()->id
        ];

        $this->assertEquals(Order::count(), 0);
        $response = $this->post('/api/v1/app/order', $data);
        $response->assertStatus(200);

        $this->assertEquals(Order::count(), 1);
        $this->assertEquals($data['amount'], $response->decodeResponseJson()['data']['current_currency_amount_paid']); 
    }
}
