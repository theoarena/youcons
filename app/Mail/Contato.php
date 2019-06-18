<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class Contato extends Mailable
{
    use Queueable, SerializesModels;

     public $nome;
     public $email;
     public $telefone;
     public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->nome = $data['nome'];
        $this->email = $data['email'];      
        $this->telefone = $data['telefone'];      
        $this->mensagem = $data['mensagem'];      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Youcons - contato pelo site')
                ->view('emails.contato');
    }
}
