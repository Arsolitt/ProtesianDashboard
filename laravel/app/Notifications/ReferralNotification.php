<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReferralNotification extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param  User  $user
     */
    public function __construct(int $user, int $ref_user)
    {
        $this->user = User::findOrFail($user);
        $this->ref_user = User::findOrFail($ref_user);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => "Кто-то зарегистрировался, используя вашу ссылку!",
            'content' => '
                <p>Большое спасибо, что поддерживаете нас!</p>
                <p>'.config('app.name').'</p>',
        ];
    }
}
