<?php

namespace App\Constants;

final class RedisLua
{
    private function __construct()
    {
    }

    const SET_PROJECT_SCRIPT = <<<LUA
        local projectKey = KEYS[1]
        redis.call('HMSET', projectKey, unpack(ARGV))
        local res = redis.call("EXPIRE", projectKey, 60)
        return res
LUA;

    const UNLOCK_SCRIPT = <<<LUA
        local key = KEYS[1]
        local uniqid = ARGV[1]
        local res = redis.call("GET", key)
        if (res and res == uniqid) then
            return redis.call("DEL", key)
        else
            return 0
        end
LUA;

}
