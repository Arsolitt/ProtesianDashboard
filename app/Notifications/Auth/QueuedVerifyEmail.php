<?php

namespace App\Notifications\Auth;

use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueuedVerifyEmail extends CustomVerifyEmailNotification implements ShouldQueue
{
    use Queueable;
}
