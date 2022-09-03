<?php

class MyDateTime extends DateTime
{
    /**
     * @return DateTime|false
     */
    public function modify(string $modifier)
    {
        return false;
    }
}

var_dump((new MyDateTime())->modify("aaa"));
