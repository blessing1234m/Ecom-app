<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return [
            'message' => 'Nouvelle commande ! Client: ' . $this->order->customer_name . ', Montant: ' . $this->order->total_amount . ' €'
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle commande créée')
                    ->line('Une nouvelle commande a été passée.')
                    ->line('Nom du client: ' . $this->order->customer_name)
                    ->line('Email du client: ' . $this->order->customer_email)
                    ->line('Téléphone du client: ' . $this->order->customer_phone)
                    ->action('Voir la commande', url('/admin/orders/' . $this->order->id))
                    ->line('Merci de vérifier les détails de la commande.');
    }
}