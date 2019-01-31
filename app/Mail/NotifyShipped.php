<?php

namespace App\Mail;

use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Content $content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('thisissonya.t@gmail.com')
            ->subject($this->content->subject)
            ->view('email.notify')
            ->with('content', $this->content);
    }
}
