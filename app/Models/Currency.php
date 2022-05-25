<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function currencyExchangeRate()
    {
        return $this->hasOne(CurrencyExchangeRate::class);
    }

    //getting all available currencies except (default) current currency
    public function getAvailableCurrencies()
    {
        $current_currency = new CurrentCurrency();
        $current_currency = $current_currency->getCurrentCurrency();
        $currencies = Currency::where('id', '!=', $current_currency->currency_id)->get();

        return $currencies;
    }

    //get all data associate whit one currency
    public function getCurrencyData($currency)
    {
        $currency_exchange_rate = new CurrencyExchangeRate();
        $currency_exchange_rate = $currency_exchange_rate->getCurrencyExchangeRate($currency);

        $currency_surcharge = new CurrencySurcharge();
        $currency_surcharge = $currency_surcharge->getCurrencySurcharge($currency);

        $currency_discount = new CurrencyDiscount();
        $currency_discount = $currency_discount->getCurrencyDiscount($currency);

        $currency_data = [
            'currency' => $currency->short_name,
            'currency_exchange_rate' => $currency_exchange_rate->exchange_rate,
            'currency_surcharge' => $currency_surcharge->amount,
            'currency_discount' => $currency_discount ? $currency_discount->discount : 0
        ];

        return $currency_data;
    }
}
