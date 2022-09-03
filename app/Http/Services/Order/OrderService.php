<?php

namespace App\Http\Services\Order;

use App\Constants\RedisKey;
use App\Enums\OrderValidateEnum;
use App\Factories\OrderFactory;
use App\Http\Response\ApiResponse;
use App\Http\Services\Order\Contracts\IOrder;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Project\ProjectRepository;
use App\Helpers\RedisLock;
use App\Helpers\BloomFilter\RedisBloomFilter;
use Illuminate\Support\Facades\Redis;

class OrderService implements IOrder
{

    public function __construct(
        private readonly OrderRepository   $orderRepository,
        private readonly ProjectRepository $projectRepository
    )
    {
    }

    private function containsOrderNo(string $orderNo)
    {
        if (RedisBloomFilter::init()->exists($orderNo)) {
            return !Redis::SADD(RedisKey::ORDER_NO_SET, $orderNo);
        }
        return false;
    }

    /**
     * @param ...$params support override
     */
    public function createPreOrder(...$params)
    {
        $order = $params[0];
        $subOrderReqs = $order['subOrderReqs'] ?? [];
        $preOrders = [];

        # lock 30s
        if (!RedisLock::lock($order['orderNo'], request()->header('Request-Id'), 30)) {
            return ApiResponse::fail(OrderValidateEnum::FAIL_LOCK_ORDER->getCode(), OrderValidateEnum::FAIL_LOCK_ORDER->getMessage());
        }

        # Prevent order no repeat
        if ($this->containsOrderNo($order['orderNo'])) {
            return ApiResponse::fail(OrderValidateEnum::ERROR_ORDER_NO->getCode(), OrderValidateEnum::ERROR_ORDER_NO->getMessage());
        }
        RedisBloomFilter::init()->add($order['orderNo']);

        # Omit sub-order processing and industry grouping process

        # Order by industry code
        foreach ($preOrders as $industryCode => $subOrders) {
            $orderResult = OrderFactory::make($industryCode)->createPreOrder($order, $subOrders);
        }

        # Omit order failure handling
        return ApiResponse::success();
    }

    public function orderDetail(string $orderNo)
    {
        return ApiResponse::success(data: []);
    }

    public function orderList($request)
    {
        return ApiResponse::success(data: []);
    }
}
