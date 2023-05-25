<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order;
    public $dishes;
    public $quantity;
    public function __construct($order, $dishes, $quantity)
    {
        $this->order = $order;
        $this->dishes = $dishes;
        $this->quantity = $quantity;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ordine confermato',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $order = $this->order; 
        $dishes = $this->dishes; 
        $quantity = $this->quantity; 
        return new Content(
            view: 'mails.OrderConfirmed',
            with: compact('order', 'dishes', 'quantity')
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}