<?php

namespace App\Http\Controllers\Api\V1\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends ApiBaseController
{
    /**
     * @bodyParam currency_id required The id of the currency.
     * @bodyParam amount required amount of exchanging 
     * @bodyParam email required user email 
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $order = new Order();
        $order = $order->createOrder($data);
        return $this->sendResponse($order, 'Order created successfully');
    }
}
