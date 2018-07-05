@extends('index-site')

@section('header')
    @include('structure/header-login') 
@endsection

@section('content')
<div class="container" id="bg-login">
    <div class="row">
        <div class="col-md-6 my-5">                       

            <h3 id="tit-login">Esqueci minha senha</h3>
            <div id="login-form">

                <p>Insira seu email de usuário, você receberá um link para redefinir sua senha.</p>
              
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-entrar" id="btn-submit">
                                {{ __('Enviar link') }}
                            </button>
                        </div>
                    </div>
                </form>    
              
            </div>
            <a href="/login" class="btn btn-voltar">Voltar</a>   
        </div>
        <div class="col-md-6  my-5"></div>
    </div>
</div>
@endsection