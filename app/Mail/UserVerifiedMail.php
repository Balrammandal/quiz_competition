<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $id;
    public function __construct($name,$id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info.zytrio@gmail.com')
            ->subject('Zytrio : Registation Completed')
            ->view('frontend.mail.verifiedMail')
            ->with([
                'name' => $this->name,
                'id' => $this->id
            ]);
    }
}
