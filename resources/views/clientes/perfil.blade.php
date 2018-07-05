@extends('index-painel-cliente')

@section('content')
  <div class="container">   	
   	<div class="row">  		

      <div class="col-md-6">
         
            <p class="p-message">Utilize o formulário abaixo para alterar seus dados de cadastro. Mantenha-os atualizados para que nossa equipe possa estar sempre em contato com você!</p>         
            

            {!! form_start($form) !!} 
            <div>
              
              <div class="row">
                <div class="col">
                  {!! form_row($form->name) !!}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  {!! form_row($form->email) !!}
                </div>
                <div class="col">
                  {!! form_row($form->birthday) !!}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  {!! form_row($form->telefone) !!}
                </div>
                <div class="col">
                  {!! form_row($form->cpf) !!}
                </div>
              </div>
              <div class="row mt-4 bg-blue" id="box-senha">
                <div class="col">                 
                  {!! form_row($form->password) !!}
                </div>           
                <div class="col">
                   <p>Caso deseje alterar sua <strong>senha</strong>, preencha os dois campos.</p>
                   <p>Guarde-a em local seguro e evite senhas fracas como: 123123, data do seu aniversário, etc</p>
                </div>    
              </div>

            </div>
            {!! form_end($form) !!}

      </div>
      <div class="col-md-6">          
         {!! form($form_picture) !!}
      </div>

		</div>
	</div> 

@endsection
