<?php

namespace App\Notifications;

use App\Models\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServerCreationError extends Notification
{
    use Queueable;

    /**
     * @var Server
     */
    private $server;

    /**
     * Create a new notification instance.
     *
     * @param  Server  $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
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
            'title' => __('Ошибка создания сервера'),
            'content' => "
                <p>Здравствуйте, <strong>{$this->server->User->name}</strong>, произошла непредвиденная ошибка...</p>
                <p>Возникла проблема с созданием сервера. Пожалуйста, свяжитесь со службой поддержки, чтобы решить эту проблему как можно скорее!</p>
                <p>Мы благодарим вас за терпение и приносим глубочайшие извинения за причиненные неудобства.</p>
                <p>".config('app.name').'</p>
            ',
        ];
    }
}
