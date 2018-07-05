<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteSimulacaoForm extends Form
{
    public function buildForm()
    {
        $this->add('id', 'hidden')            
            ->add('modalidade', 'select', [
			    'choices' => ['1' => 'Imobiliário', '2' => 'Veicular', '3' => 'Serviços'],	   
			    'empty_value' => 'Tipo de consórcio desejado',
                'label' => 'Modalidade'
			])
            ->add('credito', 'text', ['rules' => 'required|max:20', 
                'attr' => ['placeholder' => 'R$', 'class' => 'field-valor form-control'], 'label' => 'Valor do crédito' ])

            ->add('parcela', 'text', ['rules' => 'max:20',
                'attr' => ['placeholder' => 'R$', 'class' => 'field-valor form-control'], 'label' => 'Valor da parcela esperada' ])

            ->add('lance', 'text', ['rules' => 'max:20',
                'attr' => ['placeholder' => 'R$', 'class' => 'field-valor form-control'] , 'label' => 'Valor do lance disponível'])      
            
            ->add('pressa', 'select', [
                'choices' => ['1' => 'Pouca', '2' => 'Média', '3' => 'Alta'],     
                'empty_value' => 'Qual sua pressa?'               
            ])

        /*   ->add('pressa', 'choice', [
                'choices' => ['1' => 'Pouca', '2' => 'Média', '3' => 'Alta'],
                'choice_options' => [
                    'wrapper' => ['class' => 'pressa-box'],
                    'label_attr' => ['class' =>'form-check-label'] 
                ],
                'selected' => ['1'],
                'expanded' => true,
                'multiple' => false
            ])*/

            ->add('submit', 'submit', 
                [
                    'label' => 'Solicitar simulação',
                    'attr' => ['class' => 'form-control btn-enviar']
                ]
            );

        $this->showFieldErrors = true;
    }
}
