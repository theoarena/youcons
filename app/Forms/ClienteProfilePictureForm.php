<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteProfilePictureForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden')
            ->add('avatar', 'file', ["label" => "Foto de perfil"])            

            ->add('submit', 'submit',[
                'label' => 'Atualizar foto', 
                'attr' => ['class' => 'form-control btn-enviar btn']
            ]);
    }
}
