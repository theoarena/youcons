<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Simulacao;

class adminSimulacaoExport implements FromView, ShouldAutoSize
{
	use Exportable;  

	public function __construct($params)
    {
        $this->orderBy = $params["orderBy"];
        $this->active = $params["active"];
        $this->direction = $params["direction"];
        $this->modalidade_id = $params["modalidade_id"];
        $this->periodo = $params["periodo"];
    }

    public function view(): View
    {
        $periodo = json_decode($this->periodo);
        $simulacoes = new Simulacao; //pega todos

        if($this->modalidade_id != 0)
            $simulacoes = $simulacoes->where('modalidade_id',$this->modalidade_id);
        
        if($this->periodo != null)
            $simulacoes = $simulacoes->whereBetween('created_at', array($periodo->start, $periodo->end) );

        if($this->active != 2) 
            $simulacoes = $simulacoes->where('active',$this->active );        

        $simulacoes = $simulacoes->orderBy($this->orderBy, $this->direction)->get();

        return view('exports.simulacoes', [
            'simulacoes' => $simulacoes
        ]);
    }
   
}