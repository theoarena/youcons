<?php

namespace App\Mail;

use App\User;
use App\Indicacao;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//use Illuminate\Contracts\Queue\ShouldQueue;

class IndicacaoCreated extends Mailable
{
    use Queueable, SerializesModels;

     public $user;
     public $email;
     public $indicacao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $user, $indicacao)
    {
        
        $this->user = User::find($user);
        $this->email = $email;        
        $this->indicacao = Indicacao::find($indicacao);       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Youcons você foi indicado')
                ->view('emails.indicacao');
    }
}
