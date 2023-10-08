<?php

namespace App\Services;

use App\Models\User;

interface NotificationServiceInterface
{

    public function sendNotification(User $user, String $message): void;

}
