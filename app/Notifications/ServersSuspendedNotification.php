<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServersSuspendedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('Работа ваших серверов приостановлена!'))
                    ->greeting(__('Работа ваших серверов приостановлена!'))
                    ->line(__('Для автоматического включения вашего сервера/серверов вам необходимо пополнить баланс.'))
                    ->action(__('Purchase credits'), route('store.index'))
                    ->line(__('If you have any questions please let us know.'));
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
            'title' => __('Работа ваших серверов приостановлена!'),
            'content' => '
                <h5>'.__('Работа ваших серверов приостановлена!').'</h5>
                <p>'.__('Для автоматического включения вашего сервера/серверов вам необходимо пополнить баланс.').'</p>
                <p>'.__('Если у вас есть вопросы, пожалуйста, сообщите нам.').'</p>
                <p>'.'C наилучшими пожеланиями'.',<br />'.config('app.name').'
                </p>
            ',
        ];
    }
}
