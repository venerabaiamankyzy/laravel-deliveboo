<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestaurantMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $restaurant;
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($restaurant, $order)
    {
        $this->restaurant = $restaurant;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Nuovo ordine ricevuto',
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
        $restaurant = $this->restaurant;
        $order_link = "http://127.0.0.1:8000/admin/orders/" . $order->id;
        return new Content(
            view: 'mails.OrderReceived',
            with: compact('order', 'restaurant', 'order_link')
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