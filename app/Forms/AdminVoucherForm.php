<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdminVoucherForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden')                        
            ->add('codigo', 'text', ['rules' => 'required|max:20', "label" => "Código do voucher"])
            ->add('nome', 'text', ['rules' => 'required|max:80', "label" => "Nome do voucher"])
            ->add('experiencia', 'text', ['rules' => 'required|max:4', "label" => "Experiência (pontos deste voucher)"])
            ->add('valid_until', 'date', ['rules' => 'required', "label" => "Válido até"])
            ->add('submit', 'submit', ['label' => 'Salvar', 'attr' => ['class' => 'form-control btn-enviar'] ]);
    }
}
