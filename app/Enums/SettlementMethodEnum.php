<?php

namespace App\Enums;

enum SettlementMethodEnum: int implements BaseValidate
{
    case LIST = 111001;
    case MONTH = 111002;
    case PRE = 111003;
    case OUT_COUPON = 111004;
    case EXCHANGE = 111005;
    case VERIFICATION = 111006;

    function getCode(): int
    {
        return $this->value;
    }

    public function getMessage(): string
    {
        return match ($this) {
            self::LIST => "按单结算",
            self::MONTH => "押金月结",
            self::PRE => "预付款结",
            self::OUT_COUPON => "出券结算",
            self::EXCHANGE => "兑换结算",
            self::VERIFICATION => "核销结算",
        };
    }

    public static function getInstanceByCode(int $code): SettlementMethodEnum
    {
        $reflect = new \ReflectionEnum(SettlementMethodEnum::class);
        $constant = array_search($code, array_column($reflect->getConstants(), 'value','name'));
        return $reflect->getCase($constant)->getValue();
    }


}
