<?php

namespace App\Console\Commands;

use \alibaba\nacos\NacosConfig;
use Illuminate\Console\Command;

class NacosRefreshConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull config from nacos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        NacosConfig::setSnapshotPath(base_path());
        $client = \alibaba\nacos\Nacos::init(
            getenv("LARAVEL_NACOS_HOST"),
            getenv("LARAVEL_ENV"),
            getenv("LARAVEL_NACOS_DATAID"),
            getenv("LARAVEL_NACOS_GROUPID"),
            getenv("LARAVEL_NACOS_NAMESPACEID") ?: ""
        )->runOnce();
    }
}
