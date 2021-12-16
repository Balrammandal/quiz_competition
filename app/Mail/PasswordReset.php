<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $otp;
    public function __construct($name,$password)
    {
        $this->name=$name;
        $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info.zytrio@gmail.com')
            ->subject('Password Reset')
            ->view('mail.reset_password')
            ->with([
                'name' => $this->name,
                'password' => $this->password
            ]);

    }
}
