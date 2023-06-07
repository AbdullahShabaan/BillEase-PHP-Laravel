<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaidBillNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    private $bill_id ;
    private $bill_num ;

    public function __construct($bill_id , $bill_num)
    {
        $this->bill_id = $bill_id ;
        $this->bill_num = $bill_num ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
           'id' => $this->bill_id ,
           'bill_num' => $this->bill_num ,
           'desc' => 'Changed bill status' ,
           'user' => Auth()->user()->name
        ];
    }

    
}
