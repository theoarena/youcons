<?php

namespace App\Observers;

use App\Simulacao;
use App\Jobs\SimulacaoEmailJob;

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
        SimulacaoEmailJob::dispatch($simulacao,'admin-created')->onQueue('emails');
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
