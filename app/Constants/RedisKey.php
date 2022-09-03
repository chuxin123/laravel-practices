<?php

namespace App\Constants;

final class RedisKey
{
    private function __construct(){}

    /**
     * Order No Bloom Filter
     */
    const BLOOM_FILTER = "openapi:order_create:bloom_filter";

    /**
     * User Info
     */
    const CURRRENT_USER_INFO = "openapi:user_info:";

    /**
     * Project Info
     */
    const PROJECT_INFO = "openapi:project_info:";

    /**
     * Prevent hash conflict
     */
    const ORDER_NO_SET = "openapi:order_no_set";
}
