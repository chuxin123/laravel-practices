<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;
use App\Constants\RedisLua;

final class RedisLock
{
    /**
     * Redis lock
     *
     * @param string $key Lock name
     * @param string $uniqid Prevent locks from being released by other processes
     * @param int    $expiredTime Lock expired time
     *
     * @return bool
     */
    static public function lock(string $key, string $uniqid, int $expiredTime): bool
    {
        if (empty($uniqid)) {
            return false;
        }

        if (Redis::SET($key, $uniqid, "EX", $expiredTime, "NX")) {
            return true;
        }
        return false;
    }

    /**
     * Redis unlock
     *
     * @param string $key Lock name
     * @param        $uniqid Prevent locks from being released by other processes
     *
     * @return bool
     */
    static public function unlock(string $key, string $uniqid): bool
    {
        $lock = Redis::get($key);
        if ($lock != $uniqid) {
            return false;
        }

        $lua = RedisLua::UNLOCK_SCRIPT;
        return Redis::EVAL($lua, 1, $key, $uniqid);
    }
}
