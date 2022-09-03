<?php

namespace App\Enums;

enum IndustryEnum
{
    case HOTEL;
    case COUPON;
    case FOOD;
    case BUFFET;
    case AFTERNOON_TEA;
    case SOCIAL_MEAL;
    case PAY_BILL;
    case SPA;

    public function getCode(): int
    {
        return match ($this) {
            self::HOTEL => 127001,
            self::COUPON => 127002,
            self::FOOD => 127003,
            self::BUFFET => 127004,
            self::AFTERNOON_TEA => 127005,
            self::SOCIAL_MEAL => 127006,
            self::PAY_BILL => 127007,
            self::SPA => 127008,
        };
    }

    public function getMessage(): string
    {
        return match ($this) {
            self::HOTEL => "酒店",
            self::COUPON => "卡券",
            self::FOOD => "餐厅",
            self::BUFFET => "自助餐",
            self::AFTERNOON_TEA => "下午茶",
            self::SOCIAL_MEAL => "社餐",
            self::PAY_BILL => "买单",
            self::SPA => "SPA",
        };
    }

    public function getDbCode(): string
    {
        return match ($this) {
            self::HOTEL => 2,
            self::COUPON => 99,
            self::FOOD => 1,
            self::BUFFET => 4,
            self::AFTERNOON_TEA => 5,
            self::SOCIAL_MEAL => 47,
            self::PAY_BILL => 48,
            self::SPA => 3,
        };
    }

    public function getOrderTypeByName(): string
    {
        return match ($this) {
            self::HOTEL => "酒店类订单",
            self::COUPON => "卡券类订单",
            self::FOOD => "餐厅类订单",
            self::BUFFET => "自助餐类订单",
            self::AFTERNOON_TEA => "下午茶类订单",
            self::SOCIAL_MEAL => "社餐类订单",
            self::PAY_BILL => "买单类订单",
            self::SPA => "SPA类订单",
        };
    }

    public function getErpCode(): string
    {
        return match ($this) {
            self::HOTEL => "01",
            self::COUPON => "02",
            self::FOOD => "03",
            self::BUFFET => "04",
            self::AFTERNOON_TEA => "05",
            self::SOCIAL_MEAL => "06",
            self::PAY_BILL => "07",
            self::SPA => "08",
        };
    }

    public static function getInstanceByErp(string $erpCode): IndustryEnum
    {
        return match ($erpCode) {
            "01" => self::HOTEL,
            "02" => self::COUPON,
            "03" => self::FOOD,
            "04" => self::BUFFET,
            "05" => self::AFTERNOON_TEA,
            "06" => self::SOCIAL_MEAL,
            "07" => self::PAY_BILL,
            "08" => self::SPA,
        };
    }

    public static function getInstanceByCode(int $industryCode): IndustryEnum
    {
        return match ($industryCode) {
            127001 => self::HOTEL,
            127002 => self::COUPON,
            127003 => self::FOOD,
            127004 => self::BUFFET,
            127005 => self::AFTERNOON_TEA,
            127006 => self::SOCIAL_MEAL,
            127007 => self::PAY_BILL,
            127008 => self::SPA,
        };
    }
}
