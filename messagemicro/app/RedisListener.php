<?php

use Predis\Client;
$redis = new Client();

// Подписка на канал Redis Pub/Sub
$redis->pubsubLoop(function ($event) {
    // Обработка полученного события
    if ($event->kind === 'message' && $event->channel === 'channel:blog.posts') {
        $postData = json_decode($event->payload, true);
        return var_dump($postData);
        // Теперь можно использовать $postData для дальнейших действий
        // Например, сохранить информацию о посте в базе данных Slim
    }
});

// Запустить слушателя
$redis->disconnect();
