<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMailAgency extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('xuantai59@gmail.com')
                    ->view('frontend.mail.send_mail_contact')
                    ->with(
                        [
                            "messages" => "Cảm ơn bạn đã đăng kí làm gợi ý",
                        ]
                    );
    }
}
