<?php

namespace App\Services;

use App\Mail\AlertaEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService implements NotificationServiceInterface
{

    public function sendNotification(User $user, string $message): void
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln("Notificação enviada para o usuário");
    }

}
