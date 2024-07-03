<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseConfirmed extends Notification
{
    use Queueable;

    protected $order;

    protected $products;

    protected $total;

    /**
     * Create a new notification instance.
     */
    public function __construct($order, $products, $total)
    {
        $this->order = $order;
        $this->products = $products;
        $this->total = $total;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmação de Compra')
            ->view('emails.order_confirmation', [
                'notifiable' => $notifiable,
                'order' => $this->order,
                'products' => $this->products,
                'total' => $this->total,
            ]);
    }
    /**
     * Get the array representation of the notification.S
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
