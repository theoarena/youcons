<?php

namespace App\Observers;
use Illuminate\Support\Facades\Log;
use App\Simulacao;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimulacaoCreated;

class SimulacaoObserver
{
    /**
     * Handle to the simulacao "created" event.
     *
     * @param  \App\Simulacao  $simulacao
     * @return void
     */
    public function created(Simulacao $simulacao)
    {
        //envia msg de aviso ao admin
       //SimulacaoEmailJob::dispatch(,'admin-creted')->onQueue('emails');

        $log = [
              "data" => date("d/m/Y"),
              "simulação" => $simulacao,
              "user" => $simulacao->cliente
        ];
       Log::debug('Simulação', $log);

        Mail::to("vendas@youcons.com.br")->queue( new SimulacaoCreated($simulacao) );
        //Mail::to("theoarena@gmail.com")->queue( new SimulacaoCreated($simulacao) );
    }

    /**
     * Handle the simulacao "updated" event.
     *
     * @param  \App\Simulacao  $simulacao
     * @return void
     */
    public function updated(Simulacao $simulacao)
    {
        //
    }

    /**
     * Handle the simulacao "deleted" event.
     *
     * @param  \App\Simulacao  $simulacao
     * @return void
     */
    public function deleted(Simulacao $simulacao)
    {
        //
    }
}
