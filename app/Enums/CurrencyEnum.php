<?php

namespace App\Enums;

/*
 * Currency Enum
 */
enum CurrencyEnum: int
{
    case RMB = 109001;
    case HKD = 109002;
    case MOP = 109003;
    case TWD = 109004;
    case USD = 109005;
    case EUR = 109006;
    case GBP = 109007;
    case CAD = 109008;
    case CHF = 109009;
    case AUD = 109010;
    case JPY = 109011;
    case KRW = 109012;
    case THB = 109013;
    case SGD = 109014;
    case VND = 109015;
    case MYR = 109016;
    case IDR = 109017;
    case INR = 109018;
    case EGP = 109019;
    case LYD = 109020;

    public function map(): array
    {
        return match ($this) {
            self::RMB => ["人民币", 'RMB'],
            self::HKD => ["港币", 'HKD'],
            self::MOP => ["澳门", 'MOP'],
            self::TWD => ["台币", 'TWD'],
            self::USD => ["美元", 'USD'],
            self::EUR => ["欧元", 'EUR'],
            self::GBP => ["英镑", 'GBP'],
            self::CAD => ["加拿大", 'CAD'],
            self::CHF => ["瑞士", 'CHF'],
            self::AUD => ["澳元", 'AUD'],
            self::JPY => ["日元", 'JPY'],
            self::KRW => ["韩元", 'KRW'],
            self::THB => ["泰铢", 'THB'],
            self::SGD => ["新加坡元", 'SGD'],
            self::VND => ["越南盾", 'VND'],
            self::MYR => ["马币", 'MYR'],
            self::IDR => ["印尼盾", 'IDR'],
            self::INR => ["印度卢比", 'INR'],
            self::EGP => ["埃及镑", 'EGP'],
            self::LYD => ["利比亞第纳尔", 'LYD'],
        };
    }

    public function getMessage(): string
    {
        return $this->map()[0];
    }

    public static function getInstanceByOrigin(string $originCode): CurrencyEnum
    {
        $reflect = new \ReflectionEnum(CurrencyEnum::class);
        return $reflect->getCase($originCode)->getValue();
    }

    public static function getInstanceByCode(string $code): CurrencyEnum
    {
        $reflect = new \ReflectionEnum(CurrencyEnum::class);
        $constant = array_search($code, array_column($reflect->getConstants(), 'value','name'));
        return $reflect->getCase($constant)->getValue();
    }
}
