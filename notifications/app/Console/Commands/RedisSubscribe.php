<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Services\PostNotificationService;


class RedisSubscribe extends Command
{

    private PostNotificationService $notificationService;

    public function __construct(PostNotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a Redis channel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Redis::subscribe(['blog:posts'], function (string $message) {
            $this->notificationService->saveNotification($message);
            echo 'Action handled...' . PHP_EOL;
        });
    }
}
