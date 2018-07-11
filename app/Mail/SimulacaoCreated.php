<?php

namespace App\Mail;

use App\Simulacao;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class SimulacaoCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $simulacao;     

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Simulacao $simulacao)
    {
        $this->simulacao = $simulacao;       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Youcons - nova simulação')
                ->view('emails.admin_simulacao-created');
    }
}
