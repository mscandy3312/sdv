<?php

namespace App\Notifications;

use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StockBajo extends Notification
{
    use Queueable;

    public $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Alerta de Stock Bajo')
            ->line('El producto ' . $this->producto->nombre . ' tiene stock bajo.')
            ->line('Stock actual: ' . $this->producto->stock)
            ->action('Ver Producto', route('productos.edit', $this->producto));
    }

    public function toArray($notifiable)
    {
        return [
            'producto_id' => $this->producto->id,
            'nombre' => $this->producto->nombre,
            'stock' => $this->producto->stock,
        ];
    }
} 