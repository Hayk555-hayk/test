<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Redis;

trait RedisHelper {
    public function tellRedis($post, $action) {
        $data = json_encode(['action' => $action, 'title' => $post->title, 'author' => $post->author, 'publication_year' => $post->publication_year]);
        Redis::publish('channel:blog.posts', $data);
        return true;
    }
}
