<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
use Illuminate\Support\Facades\URL;

class inviteAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $club;

    public function __construct(String $club)
    {
        //
        $this->club = $club;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $superAdmin = Auth::guard('superAdmin')->user();
        $url = URL::to('/');
        return $this->subject('Invitación a dBASE')->view('mails.inviteAdmin')->with(compact(['superAdmin','url']));
    }
}
