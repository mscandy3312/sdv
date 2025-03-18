<?php

namespace App\Mail;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaCompletada extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;

    public function __construct(Venta $venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        $pdf = PDF::loadView('ventas.pdf', ['venta' => $this->venta]);

        return $this->subject('Comprobante de Venta #' . str_pad($this->venta->id, 6, '0', STR_PAD_LEFT))
                    ->view('emails.ventas.completada')
                    ->attachData($pdf->output(), 'comprobante.pdf');
    }
} 