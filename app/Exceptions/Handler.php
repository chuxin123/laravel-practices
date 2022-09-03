<?php

namespace App\Exceptions;

use App\Enums\SystemErrorEnum;
use App\Http\Response\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $content = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'datetime' => date("Y-m-d H:i:s"),
            ];
            Log::error('[system_error][trace_info]', $content);
        })->stop();
    }

    public function render($request, Throwable $e)
    {
        Log::error('[system_error][http_status_error]', [
            'trace' => $e->getTraceAsString(),
            'class' => $e::class,
        ]);
        return ApiResponse::fail(SystemErrorEnum::SERVER_ERROR->getCode(), SystemErrorEnum::SERVER_ERROR->getMessage());
    }
}
