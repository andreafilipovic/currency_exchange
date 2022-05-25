<?php

namespace App\Http\Controllers\Api\V1\App;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = new Currency();
        $currencies = $currencies->getAvailableCurrencies();
        return view('home',["currencies"=>$currencies]);
        //return $this->sendResponse($currencies, 'Currencies retrieved successfully');
    }

    public function infoCurrency(Currency $currency)
    {
        $getInfo = new Currency();
        $getInfo = $getInfo->getCurrencyData($currency);
        return $this->sendResponse($getInfo, 'Currency data retrieved successfully');
    }
}
