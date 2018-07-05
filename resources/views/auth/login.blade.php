@extends('index-site')

@section('header')
    @include('structure/header-login') 
@endsection

@section('content')
<div class="container" id="bg-login">
    <div class="row">
        <div class="col-md-6 my-5">                       

                <h3 id="tit-login">Área de clientes</h3>
                <div id="login-form">

                    <p>Insira seus dados ou utilize uma conta do Facebook para entrar.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Endereço de email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-entrar" id="btn-submit"> Entrar </button>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar de mim
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4 offset-md-4">
                        <div class="col">                               
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Esqueci minha senha
                            </a> |
                            <a class="btn btn-link" href="{{ route('register') }}">
                                Novo cadastro
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{url('/redirect')}}" class="btn btn-facebook">Logar com o Facebook</a>                    
                </div>
        </div>
        <div class="col-md-6  my-5"></div>
    </div>
</div>
@endsection
