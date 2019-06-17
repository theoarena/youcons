<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class HomeForm extends Form
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
                'attr' => ['placeholder' => 'R$'], 'label' => 'Valor do crédito' ])

            ->add('parcela', 'text', ['rules' => 'max:20',
                'attr' => ['placeholder' => 'R$'], 'label' => 'Valor da parcela esperada' ])

            ->add('lance', 'text', ['rules' => 'max:20',
                'attr' => ['placeholder' => 'R$'] , 'label' => 'Valor do lance disponível'])            
            ->add('obs', 'textarea', ['rules' => 'max:250', 'attr' => ['placeholder' => 'Observações'] ])
            
            /*->add('pressa', 'select', [
                'choices' => ['1' => 'Pouca', '2' => 'Média', '3' => 'Alta'],               
                'empty_value' => 'Pressa'
            ])*/

            ->add('submit', 'submit', ['label' => 'Solicitar simulação', 
                   "attr" => ["class" => "btn"]
                ]);

        $this->showFieldErrors = true;
    }
}
