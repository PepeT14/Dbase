<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class inviteMister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $team;

    public function __construct($team)
    {
        //
        $this->team = $team;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $club = Auth::guard('admin')->user()->club;
        $url = env('APP_URL');
        return $this->subject('Invitación a dBASE')->view('mails.inviteMister')->with(compact(['url','club']));
    }
}
