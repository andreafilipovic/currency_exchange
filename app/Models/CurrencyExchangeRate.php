<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchangeRate extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    //getting exchange rate for passed currency
    public function getCurrencyExchangeRate($currency)
    {
        $current_currency = new CurrentCurrency();
        $current_currency = $current_currency->getCurrentCurrency();

        $exchange_rate = CurrencyExchangeRate::where([
            'currency_from_id' => $current_currency->currency_id,
            'currency_to_id' => $currency->id
        ])->first();

        return $exchange_rate;
    }

    public function updateExchangeRates($data)
    {
        $available_currencies_exchange_rates = $this->getExchangeRates($data['quotes'], ['USDEUR', 'USDJPY', 'USDGBP']);
        foreach ($available_currencies_exchange_rates as $currency => $value) {
            switch ($currency) {
                case 'USDEUR':
                    $this->updateExchaneRate('USD', 'EUR', $value);
                    break;
                case 'USDJPY':
                    $this->updateExchaneRate('USD', 'JPY', $value);
                    break;
                case 'USDGBP':
                    $this->updateExchaneRate('USD', 'GBP', $value);
                    break;
            }
        }
    }

    //getting array of just necessary currency exchange rates
    public function getExchangeRates($currencies_exchane_rates, $currencies)
    {
        $data = [];
        foreach ($currencies_exchane_rates as $key => $value) {
            if (in_array($key, $currencies)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }

    //updating passed currency exchange rate
    public function updateExchaneRate($currency_name_from, $currency_name_to, $exchane_rate_amount)
    {
        $currency_form = Currency::where('short_name', $currency_name_from)->first();
        $currency_to = Currency::where('short_name', $currency_name_to)->first();

        $currency_exchange_rate = CurrencyExchangeRate::where([
            'currency_from_id' => $currency_form->id,
            'currency_to_id' => $currency_to->id
        ])->first();

        $currency_exchange_rate->exchange_rate = $exchane_rate_amount;
        $currency_exchange_rate->save();

        return $currency_exchange_rate;
    }
}
