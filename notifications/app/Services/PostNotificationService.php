<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PostNotification;

class PostNotificationService
{
    /**
     * Save notification based on message data.
     *
     * @param string $message
     * @return bool
     */
    public function saveNotification(string $message): bool
    {
        $data = json_decode($message);

        $mainAction = match ($data->action) {
            'post_created' => 'created',
            'post_updated' => 'updated',
            'post_deleted' => 'deleted',
            default => 'changed',
        };

        $actionMessage = "Blog $data->author was $mainAction by $data->author in $data->publication_year year";

        $newNotification = [
            'post_id' => $data->post_id,
            'message' => $actionMessage,
        ];

        PostNotification::create($newNotification);

        return true;
    }
}
