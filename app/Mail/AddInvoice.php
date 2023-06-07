<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $bill_ID ;
    private $bill_name ;

    public function __construct($bill_ID , $bill_name)
    {
        $this->bill_ID = $bill_ID ;
        $this->bill_name = $bill_name ;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'Add Invoice',

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url = 'http://localhost/BillEase/public/details/'.$this->bill_ID ;

        return new Content(
            markdown: 'emails.addBill',
            with: [

                'Bill' => $this->bill_ID,
                'name' => $this->bill_name,
                'url' => $url,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
