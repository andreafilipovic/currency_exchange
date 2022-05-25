<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyDiscount extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    //getting currency discount for passed currency
    //currency discount added so it can be configurable for currnecy
    public function getCurrencyDiscount($currency)
    {
        $current_currency = new CurrentCurrency();
        $current_currency = $current_currency->getCurrentCurrency();

        $currency_discount = CurrencyDiscount::where([
            'currency_from_id' => $current_currency->currency_id,
            'currency_to_id' => $currency->id,

            ])->first();
        
        return $currency_discount;
    }
}
