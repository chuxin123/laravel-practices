<?php

namespace App\Http\Middleware;

use App\Repositories\Project\ProjectRepository;
use Closure;
use Illuminate\Http\Request;
use App\Http\Response\ApiResponse;
use App\Enums\SystemErrorEnum;

class RequestIngress
{

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(
        private ProjectRepository $projectRepository
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request                                                                          $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $projectCode = $request->header('Openapi-API-Key');
        if (empty($projectCode) || !is_numeric($projectCode)) {
            ApiResponse::fail(SystemErrorEnum::AUTH_ERROR->getCode(), SystemErrorEnum::AUTH_ERROR->getMessage());
        }
        $project = $this->projectRepository->getProject($projectCode);
        if (empty($project)) {
            ApiResponse::fail(SystemErrorEnum::AUTH_ERROR->getCode(), SystemErrorEnum::AUTH_ERROR->getMessage());
        }

        // The current project information is injected into th request body
        $request->merge(['global_project_info' => [
            'projectId' => $project['projectId'],
            'projectName' => $project['projectName'],
            'projectCode' => $projectCode,
            'secret' => $project['apiSecret'],
        ]]);
        return $next($request);
    }
}
