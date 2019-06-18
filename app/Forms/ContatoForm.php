<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ContatoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text', ['label_show' => false,'rules' => 'required|max:60', 'attr' => ['placeholder' => 'Nome', "class" => "form-control"] ])
            ->add('email', 'email', ['label_show' => false, 'rules' => 'required|email|max:50', 'attr' => ['placeholder' => 'E-mail', "class" => "form-control"] ])
            ->add('telefone', 'tel', ['label_show' => false, 'rules' => 'max:50', 'attr' => ['placeholder' => 'Telefone', "class" => "form-control"] ])
            ->add('modo', 'select', [
                'choices' => 
                    [
                        "" => "Como prefere?",
                        1 => "Agendar reunião por Skype",
                        2 => "Agendar reunião presencial (Campinas ou São Paulo)",
                        3 => "Contato por whatsapp",
                        4 => "Contato por telefone/celular"
                    ],                
                'selected' => "",
                'label_show' => false                
            ])
            ->add('mensagem', 'textarea', ['rules' => 'max:500', 'attr' => ['placeholder' => 'Conte-nos o que você precisa, informe a melhor data para uma reunião, etc', "class" => "form-control"] ])
            ->add('submit', 'submit', ['label' => 'Entrar em contato', 
                   "attr" => ["class" => "btn btn-enviar float-right"]
                ]);

        $this->showFieldErrors = true;
    }
}
