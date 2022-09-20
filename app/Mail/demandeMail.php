<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class demandeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
    */

    public function build()
    {
        $objet="";
        if($this->data["demande"]=="appel")
        {
             $objet='Demander à être appeler ';
        }
        elseif($this->data["demande"]=="emballage")
        {
            $objet='Commande de carton';
        }
        elseif($this->data["demande"]=="enlevement")
        {
             $objet='Demande d’enlèvement';
        }
        return $this->subject($objet)->view('emails.mailDemande');
    }
}
