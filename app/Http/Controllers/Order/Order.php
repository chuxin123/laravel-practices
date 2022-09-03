<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Services\Order\OrderService;
use App\Http\Response\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Order extends Controller
{

    public function __construct(
        private readonly OrderService $orderService
    )
    {
    }

    public function createOrder(OrderRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'orderNo' => 'required|max:100',
        ], $request->messages());
        if ($validator->fails()) {
            return ApiResponse::fail(
                message: $validator->errors()->first()
            );
        }
        return $this->orderService->CreatePreOrder($request->all());
    }

    public function detail(Request $request)
    {
        return $this->orderService->orderDetail($request->orderNo);
    }

    public function orderList(Request $request)
    {
        return $this->orderService->orderList($request);
    }
}
