<?php

namespace App\Models;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Mailjet\Resources;

class Order extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    //creating new purchase
    public function createOrder($data)
    {
        try {
            $currency = Currency::find($data['currency_id']);
            $currency_data = new Currency();
            $currency_data = $currency_data->getCurrencyData($currency);

            $purchased_amount_and_details = $this->calculatePurchasedAmount($currency_data, $data['amount']);

            DB::beginTransaction();
            $order = new Order();
            $order->email = $data['email'];
            $order->currency_id = $data['currency_id'];
            $order->currency_exchange_rate = $currency_data['currency_exchange_rate'];
            $order->currency_surcharge = $currency_data['currency_surcharge'];
            $order->currency_surcharge_amount = $purchased_amount_and_details['currency_surcharge_amount'];
            $order->current_currency_amount_paid = $data['amount'];
            $order->currency_discount = $currency_data['currency_discount'];
            $order->currency_discount_amount = $purchased_amount_and_details['currency_discount_amount'];
            $order->foreing_currency_amount_purchased = $purchased_amount_and_details['purchased_amount'];
            $order->save();
            DB::commit();

            $this->additionalActions($order, $currency);

        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong', 'success' => false], 400);
        }

        return $order;
    }

    //calculating all necessities associate whit one currency for one order
    public function calculatePurchasedAmount($currency_data, $amount)
    {
        $foreign_currency_amount = $amount * $currency_data['currency_exchange_rate'];
        $currency_surcharge_amount = ($currency_data['currency_surcharge'] / 100) * $foreign_currency_amount;

        $foreign_currency_amount_purchased = $foreign_currency_amount - $currency_surcharge_amount;

        $currency_discount_amount = 0;
        if ($currency_data['currency_discount']) {
            $currency_discount_amount = ($currency_data['currency_discount'] / 100) * $foreign_currency_amount_purchased;
            $foreign_currency_amount_purchased += $currency_discount_amount;
        }

        $data = [
            'purchased_amount' => $foreign_currency_amount_purchased,
            'currency_surcharge_amount' => $currency_surcharge_amount,
            'currency_discount_amount' => $currency_discount_amount
        ];

        return $data;
    }

    //sending email to user with all order details
    public function orderEmail($data, $currency)
    {
        $mj = new \Mailjet\Client(env('MAIL_KEY'), env('MAIL_SECRET'), true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "andrea.filipovic.pvt@gmail.com",
                    ],
                    'To' => [
                        [
                            'Email' => $data->email,
                        ]
                    ],
                    'Subject' => "Successful currency purchase",
                    'TextPart' => "My first Mailjet email",
                    'HTMLPart' => "<p>You have successfully purchased $data->foreing_currency_amount_purchased $currency->short_name for $data->current_currency_amount_paid USD.</p>
              <p>Currency exchange rate: $data->currency_exchange_rate</p>
              <p>Currency surcharge: $data->currency_surcharge%</p>
              <p>Currency surcharge amount: $data->currency_surcharge_amount $currency->short_name</p>
              <p>Discount: $data->currency_discount%</p>
              ",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
    }


    //executing any additional actions for some currencies like sending email, can be added more in future
    public function additionalActions($order, $currency)
    {
        if ($currency->short_name == 'GBP') {
            $this->orderEmail($order, $currency);
        }
    }
}
