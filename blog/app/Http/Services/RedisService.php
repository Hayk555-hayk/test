<?php

declare(strict_types=1);

namespace App\Http\Services;

use Illuminate\Support\Facades\Redis;
use App\Models\Post;

class RedisService
{
    public function tellRedis(Post $post, string $action): bool
    {
        $data = json_encode([
            'action' => $action,
            'title' => $post->title,
            'author' => $post->author,
            'publication_year' => $post->publication_year
        ]);

        Redis::publish('blog:posts', $data);

        return true;
    }
}
