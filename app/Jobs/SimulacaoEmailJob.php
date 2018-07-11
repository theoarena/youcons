<?php

namespace App\Jobs;

use App\Simulacao;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

use App\Mail\SimulacaoCreated;

class SimulacaoEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $simulacao;
    protected $tipo;
    protected $default_email = "theoarena@gmail.com";
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Simulacao $simulacao,$tipo = "admin-created")
    {
         $this->simulacao = $simulacao;        
         $this->tipo = $tipo;        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->tipo) {
            case 'admin-created':
                Mail::to($this->default_email)->send( new SimulacaoCreated($this->simulacao) );
                break;            
            default: break;
        }
    }
}
