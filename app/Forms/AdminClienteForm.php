<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdminClienteForm extends Form
{
    public function buildForm()
    {        
        $redirect = $this->getData('is_admin');

        $this
            ->add('id', 'hidden')
            ->add('redirect', 'hidden', ['value' => $redirect])
            ->add('active', 'checkbox', ['value' => 1, 'label' => 'Ativo?'])
            ->add('name', 'text', ['rules' => 'required|max:60'])
            ->add('email', 'text', ['rules' => 'required|email|max:250'])
            ->add('telefone', 'text', ['rules' => 'required|max:50'])
            ->add('password', 'password',['rules' => 'required|max:10', 'label' => 'Senha'])

            ->add('roles', 'select', [
                'choices' => ['2' => 'Clientes', '3' => 'Parceiros', '4' => 'Vendedores'],                
                'empty_value' => "Selecione o tipo de usuário",
                'label' => 'Tipo de usuário'
                /*
                'selected' => function ($data) {
                    var_dump($data);exit;
                    // Returns the array of short names from model relationship data
                    return array_pluck($data, 'short_lang_name');
                }*/
            ])

            ->add('submit', 'submit', ['label' => 'Salvar']);
    }
}
