<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApprovalNotification;

class GmailTestEmail extends Command
{
    // Command signature
    protected $signature = 'email:gmail-test {email} {status=approved}';

    // Command description
    protected $description = 'Send a test email to any email using Gmail SMTP';

    public function handle()
    {
        $email = $this->argument('email');
        $status = $this->argument('status'); // approved or disapproved

        // Create a dummy user object to send the email
        $user = new class($email) {
            public $firstName = 'Test';
            public $lastName = 'User';
            public $email;

            public function __construct($email) {
                $this->email = $email;
            }
        };

        try {
            Mail::to($email)->send(new UserApprovalNotification($user, $status));
            $this->info("Test email sent to {$email} with status '{$status}'!");
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
        }

        return 0;
    }
}