<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentCurrency extends Model
{
    use HasFactory;

    //current currency - default currency in app, all conversion form current currency, can be changed in future
    //getting current currency
    public function getCurrentCurrency()
    {
        $status_type_current_currency = StatusType::where('name', 'Current currency')->first();
        $status_current_currency = Status::where([
            'status_type_id' => $status_type_current_currency->id,
            'name' => 'active'
        ])->first();
        $current_currency = CurrentCurrency::where('status_id', $status_current_currency->id)->first();

        return $current_currency;
    }
}
