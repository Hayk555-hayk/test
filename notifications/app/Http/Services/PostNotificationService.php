<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\PostNotification;

class PostNotificationService
{
    public function saveNotification(string $message): bool
    {

        $data = json_Decode($message);
        // PostNotification::create($data);

        return true;
    }
}
