<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected  $request;

    public function __construct($request)
    {
        //
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'firstName' => $this->request->firstName,
            'lastName' => $this->request->lastName,
            'telephone' => $this->request->phone,
            'email' => $this->request->email,
            'subject' => $this->request->subject,
            'contactMessage' => $this->request->message,
        ];

        return $this->view('emails.message', $data)->subject("Contact Us");
    }
}
