<?php

namespace App\Enums;

interface BaseValidate
{
    public function getMessage(): string;

    public function getCode(): int;
}
