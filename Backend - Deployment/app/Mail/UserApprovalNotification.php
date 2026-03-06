<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserApprovalNotification extends Mailable
{
    use SerializesModels;

    public $user;
    public $status;

    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('CAPS System Notification')
            ->view('emails.user_status');
    }
}