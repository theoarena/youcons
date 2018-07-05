<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteProfileForm extends Form
{
    public function buildForm()
    {        
        $birthday = $this->getData('birthday');
        $password = config('constants.default_password');

        $this
            ->add('id', 'hidden')
            ->add('name', 'text', ['rules' => 'required|max:60', "label" => "Nome"])
            ->add('email', 'text', [
                'rules' => 'required|email|max:250', 
                'label' => "Email",
                'attr' => ['readonly']
            ])
            ->add('telefone', 'tel', ['rules' => 'required|max:50', "label" => "Telefone"])
            ->add('cpf', 'text', ['rules' => 'required|max:50', "label" => "CPF (somente números)"])
            ->add('birthday', 'date', ['rules' => 'required', "label" => "Data de nascimento", 'value' => $birthday])
            
            ->add('password', 'repeated', [
                'type' => 'password',
                'second_name' => 'password_confirmation',
                'first_options' => ['rules' => 'required|max:30', 'label' => "Senha de acesso" , 'value' => $password],
                'second_options' => ['rules' => 'max:30', 'label' => "Repita sua senha" ],
            ])

            ->add('submit', 'submit',[
                'label' => 'Salvar meus dados', 
                'attr' => ['class' => 'form-control btn-enviar btn']
            ]);
    }
}
