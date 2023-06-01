<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data =[];


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {

        return $this->from(config('mail.from.address'), 'GCC IMS Notification')
                    ->subject($this->data['subject'])
                    ->html($this->data['template'])
                    ->with('data', $this->data);

    }
}
