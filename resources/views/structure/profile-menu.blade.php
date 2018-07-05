<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Minha conta</a>
    <div class="dropdown-menu">      
      <a class="dropdown-item" href="{{ route('clientes_perfil') }}">Dados da conta</a>       
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
    </div>
  </li>