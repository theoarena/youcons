<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

use Illuminate\Database\Eloquent\Model;
use App\Vendedor;

class AdminSimulacaoForm extends Form
{
    public function buildForm()
    {
        $this->add('id', 'hidden')   

        ->add('vendedores', 'entity', [
            'class' => 'App\Vendedor',
            'property' => 'users.name',
            'property_key' => 'vendedores.id',
            'query_builder' => function (Vendedor $vendedor) {                   
                return $vendedor->join('users', 'users.id', '=', 'vendedores.user_id')->where('active',1);
            },
            'empty_value' => 'Selecione um vendedor'
        ])     
        ->add('submit', 'submit', 
            [
                'label' => 'Salvar',
                'attr' => ['class' => 'form-control btn btn-enviar']
            ]
        );

        $this->showFieldErrors = true;
    }
}
