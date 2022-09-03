<?php

namespace App\Enums;

enum PayStatusEnum: int implements BaseValidate
{

    case NOT_PAY = 131001;
    case HAVE_TO_PAY = 131002;
    case REFUNDING = 131003;
    case PART_REFUND_SUCCESS = 131004;
    case ALL_REFUND_SUCCESS = 131005;
    case REFUND_FAIL = 131006;

    function getCode(): int
    {
        return $this->value;
    }

    public function getMessage(): string
    {
        return match ($this) {
            self::NOT_PAY => "未支付",
            self::HAVE_TO_PAY => "已支付",
            self::REFUNDING => "退款中",
            self::PART_REFUND_SUCCESS => "部分退款",
            self::ALL_REFUND_SUCCESS => "全部退款",
            self::REFUND_FAIL => "退款失败",
        };
    }


}
