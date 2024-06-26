<?php

namespace App\Notifications\Ticket\User;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyNotification extends Notification implements ShouldQueue
{
    //THIS IS BASICALLY NOT USED ANYMORE WITH INVOICENOTIFICATION IN PLACE

    use Queueable;

    private Ticket $ticket;

    private User $user;

    private $newmessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, $newmessage)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->newmessage = $newmessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['mail', 'database'];

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('[Номер обращения: '.$this->ticket->ticket_id.'] '.$this->ticket->title)
            ->markdown('mail.ticket.user.reply', ['ticket' => $this->ticket, 'user' => $this->user, 'newmessage' => $this->newmessage]);
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
            'title' => '[Номер обращения: '.$this->ticket->ticket_id.'] '.$this->ticket->title,
            'content' => "
                <p>К вашему обращению {$this->ticket->ticket_id} был добавлен ответ:</p>
                <br>
                <p><strong>Ответ:</strong></p>
                <p>{$this->newmessage}</p>
            ",
        ];
    }
}
