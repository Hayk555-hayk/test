<?php

require __DIR__ . '/../vendor/autoload.php'; 

use Predis\Client;
$redis = new Client();

// Подписка на канал Redis Pub/Sub
$redis->pubsubLoop(function ($event) {
    // Обработка полученного события
    if ($event->kind === 'message' && $event->channel === 'channel:blog.posts') {
        $postData = json_decode($event->payload, true);

        $message = 'Hello';
        $postId = 1;

        try {
            // Prepare the SQL statement
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("INSERT INTO post_notifications (message, post_id) VALUES (:message, :post_id)");

            // Bind parameters and execute the statement
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':post_id', $postId);
            $stmt->execute();

            echo "Data inserted successfully!";
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }

    }
});

$redis->disconnect();
