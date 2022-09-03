<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 *
 * @OA\Info(
 *     version="1.0.0",
 *     title="中台api",
 *     description="这是演示服务，该文档提供了演示swagger api的功能"
 * )
 *
 * @OA\Server(
 *     url="http://localhost",
 *     description="开发环境",
 * )
 * @OA\Server(
 *     url="http://uat",
 *     description="uat环境",
 * )
 *
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
