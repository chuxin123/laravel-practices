<?php

namespace App\Repositories\Project;

use App\Constants\RedisKey;
use App\Constants\RedisLua;
use App\Models\Project\Project;
use Illuminate\Support\Facades\Redis;
use App\Models\Project\ProjectInternalPlatform;

class ProjectRepository
{
    /**
     * Get project information
     *
     * @param string|int $projectCode
     *
     * @return array
     *
     */
    final function getProject(string|int $projectCode): array
    {
        $projectKey = RedisKey::PROJECT_INFO . $projectCode;
        if ($project = Redis::HGETALL($projectKey)) return $project;
        $project = Project::where("project_code", '=', $projectCode)->sole()->toArray();

        $lua = RedisLua::SET_PROJECT_SCRIPT;
        $funcParams = [$lua, 1, $projectKey];
        foreach ($project as $key => $value) {
            array_push($funcParams, $key, $value);
        }

        Redis::EVAL(...$funcParams);
        return $project;
    }
}
