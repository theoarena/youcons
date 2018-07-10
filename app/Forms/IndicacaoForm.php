<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class IndicacaoForm extends Form
{
    public function buildForm()
    {
        $indicacao_id = $this->getData('indicacao_id');

        $this->add('id', 'hidden', ['value' => $indicacao_id])
            ->add('nome', 'text', ['rules' => 'required|max:50', 'label' => 'Nome', 'attr' => ['placeholder' => 'Seu nome'] ])
            ->add('password', 'repeated', [
                'type' => 'password',
                'second_name' => 'password_confirmation',
                'first_options' => ['rules' => 'required|max:30', 'label' => "Senha de acesso" ],
                'second_options' => ['rules' => 'required|max:30', 'label' => "Repita sua senha" ],
            ])
            ->add('submit', 'submit', ['label' => 'Ir para a área de clientes', 
                   "attr" => ["class" => "btn btn-entrar"]
                ]);

        $this->showFieldErrors = true;
    }
}
