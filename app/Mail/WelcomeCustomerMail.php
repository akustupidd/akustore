<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;

class WelcomeCustomerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Welcome to Our Platform!')
                      ->view('web-page.emails.welcome')
                      ->with(['customer' => $this->customer]);

        $attachmentPath = public_path('assets-web/images/dark 1.png');
        if (file_exists($attachmentPath)) {
            $email->attach($attachmentPath, [
                'as' => 'dark 1.png',
                'mime' => 'image/png',
            ]);
        }

        return $email;
    }
}
