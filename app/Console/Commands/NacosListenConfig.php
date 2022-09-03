<?php

namespace App\Console\Commands;

use alibaba\nacos\listener\config\ListenerConfigRequestErrorListener;
use alibaba\nacos\NacosConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NacosListenConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nacos:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nacos listener';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        NacosConfig::setSnapshotPath(base_path());
        ListenerConfigRequestErrorListener::add(function ($message) {
            Log::error("Nacos listen error", [$message]);
        });

        $client = \alibaba\nacos\Nacos::init(
            getenv("LARAVEL_NACOS_HOST"),
            getenv("LARAVEL_ENV"),
            getenv("LARAVEL_NACOS_DATAID"),
            getenv("LARAVEL_NACOS_GROUPID"),
            getenv("LARAVEL_NACOS_NAMESPACEID") ?: ""
        )->listener();
    }
}
