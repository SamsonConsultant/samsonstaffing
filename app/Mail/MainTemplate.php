<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MainTemplate extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        if(isset($this->data['attach_pdf']) && $this->data['attach_pdf'] != ''){
            return $this->from(get_site_email(), get_site_title())->view($this->data['view'])->attach($this->data['attach_pdf'], [
                        'as' => $this->data['pdf_filename'],
                        'mime' => 'application/pdf',
                    ])->subject($this->data['subject'])->with($this->data);
        } else {
            return $this->from(get_site_email(), get_site_title())->view($this->data['view'])
                    ->subject($this->data['subject'])
                    ->with($this->data);
        }
    }
}
