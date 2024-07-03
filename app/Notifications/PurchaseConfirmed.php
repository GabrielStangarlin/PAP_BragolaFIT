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
    public function toMail($notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Confirmação de Compra')
            ->greeting('Olá '.$notifiable->name.'!')
            ->line('Obrigado pela sua compra na nossa loja.')
            ->line('Aqui estão os detalhes da sua compra:')
            ->line('Pedido ID: '.$this->order->id);

        foreach ($this->products as $product) {
            $mailMessage->line($product->name.' - '.$product->pivot->quantity.' x € '.$product->price);
        }

        $mailMessage->line('Preço total: € '.$this->total)
            ->line('Obrigado por comprar connosco!')
            ->salutation('Atenciosamente, Equipe da Loja');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
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
