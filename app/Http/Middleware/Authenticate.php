<?php

namespace App\Http\Middleware;

use App\Constants\RedisKey;
use App\Enums\SystemErrorEnum;
use App\Http\Response\ApiResponse;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Redis;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->header('token') ?? '';
        $userInfo = Redis::get(RedisKey::CURRRENT_USER_INFO . $token);
        if (!empty($res)) {
            $userInfo = json_decode($userInfo, true);
            $request->merge(['global_user_info' => [
                'userId' => $userInfo['id'],
                'userName' => $userInfo['name']
            ]]);
            return $next($request);
        } else {
            return ApiResponse::fail(SystemErrorEnum::AUTH_ERROR->getCode(), SystemErrorEnum::AUTH_ERROR->getMessage());
        }
    }
}
