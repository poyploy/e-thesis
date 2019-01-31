<?php

namespace App\Mail;

use App\Models\Present;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $present;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Present $present)
    {
        //
        $this->present = $present;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('thisissonya.t@gmail.com')
            ->subject('notify presentation')
            ->view('email.notify')
            ->with('present', $this->present);
    }
}
