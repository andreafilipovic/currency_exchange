<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencySurcharge extends Model
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

    //getting currency surcharge for passed currency
    public function getCurrencySurcharge($currency)
    {
        $current_currency = new CurrentCurrency();
        $current_currency = $current_currency->getCurrentCurrency();

        $currency_surcharge = CurrencySurcharge::where([
            'currency_from_id' => $current_currency->currency_id,
            'currency_to_id' => $currency->id
            ])->first();
       
        return $currency_surcharge;
    }
}
