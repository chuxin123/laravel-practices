<?php

namespace App\Enums;

enum SystemErrorEnum: int implements BaseValidate {

    case ACCESS_FORBIDDEN = -403;
    case PARAMS_ERROR = -301;
    case AUTH_ERROR = -401;
    case SERVER_ERROR = -500;
    case SYSTEM_ABNORMAL = -503;

    function getCode(): int
    {
        return $this->value;
    }

    function getMessage(): string
    {
        return match ($this) {
            self::ACCESS_FORBIDDEN => '禁止访问',
            self::PARAMS_ERROR => '参数错误',
            self::AUTH_ERROR => '鉴权不通过',
            self::SERVER_ERROR => '服务器错误',
            self::SYSTEM_ABNORMAL => '安全性异常',
        };
    }
}
