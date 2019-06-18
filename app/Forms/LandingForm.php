<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LandingForm extends Form
{
    public function buildForm()
    {
        $this->add('id', 'hidden')
            ->add('nome', 'text', ['rules' => 'required|max:60', 'attr' => ['placeholder' => 'Nome'] ])
            ->add('email', 'email', ['rules' => 'required|email|max:50', 'attr' => ['placeholder' => 'E-mail'] ])
            ->add('telefone', 'tel', ['rules' => 'required|max:50', 'attr' => ['placeholder' => 'Telefone'] ])
            ->add('modalidade', 'select', [
			    'choices' => ['1' => 'Imobiliário', '2' => 'Veicular', '3' => 'Serviços'],			   
			    'empty_value' => 'Tipo de consórcio desejado'
			])
            ->add('credito', 'text', ['rules' => 'required|max:20', 
                'attr' => ['placeholder' => 'R$', 'maxlength' => '13'], 'label' => 'Valor do crédito' ])

            ->add('lance', 'text', ['rules' => 'max:20',
                'attr' => ['placeholder' => 'R$', 'maxlength' => '13'] , 'label' => 'Valor do lance'])

            ->add('submit', 'submit', ['label' => 'Solicitar simulação', 
                   "attr" => ["class" => "btn"]
                ]);

        $this->showFieldErrors = true;
    }
}
