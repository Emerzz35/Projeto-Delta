<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/main-cadastro.css">
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
</head>

<body class="text-md" style="min-height: 100vh;">
<header>
    <a href="{{route('produto.index')}}" class="logo"><img src="/assets/logo.png" alt="Logo Delta"> DELTA </a>
    <ul class="navlist">
        <li><a href="{{route('produto.index')}}" id="pg-atual">Home</a></li>
        @if (Auth::check()) 
        <li><a href="{{route('profile.edit')}}">{{ Auth()->user()->USUARIO_NOME}}</a></li>
        @else
        <li><a href="{{route('profile.edit')}}">Faça Login</a></li>
        @endif
        <li><a href="{{route('sobre')}}">Sobre </a></li>
    </ul>
    <div class="menu-icons">
    <form action="{{ route('produto.filtro-pesquisa') }}" method="post" class="input-group">
    @csrf
    <div class="form-outline" data-mdb-input-init>
        <input type="search" id="form1" name="query" class="form-control" placeholder="Pesquise" />
    </div>
    <button type="submit" class="btn pesquisa" data-mdb-ripple-init>
        <box-icon id="search" name='search' size="2rem" color="white" class="fas fa-search"></box-icon>
    </button>
</form>
        <a href="{{route('carrinho.show')}}"><box-icon id="cart" name='cart' size='2rem' color="white"></box-icon></a>
        <div class="dropdown" id="dropdownnav">
            <button class="dropdown-toggle" type="button" id="navdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                <box-icon id="user" name='user-circle' size='2rem' color="white"></box-icon>
            </button>
            <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navdrop">  
                @if (Auth::check()) 
                <a href="{{route('profile.edit')}}" class="dropdown-item">Ver perfil</a>
                <a href="{{route('pedido.index')}}" class="dropdown-item">Ver pedidos</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{route('login')}}" class="dropdown-item">Faça Login</a>
                <a href="{{ route('register') }}" class="dropdown-item">Registrar</a>
                @endif  
            </div>
        </div>
    </div>
</header>
    <section class="formu">
    <form class="fm" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="USUARIO_NOME">Nome</label>
            <input type="text" class="form-control fr" id="USUARIO_NOME" name="USUARIO_NOME" placeholder="Nome completo">
        </div>
        <div class="form-group">
            <label for="USUARIO_EMAIL">E-mail</label>
            <input type="text" class="form-control fr" id="USUARIO_EMAIL" name="USUARIO_EMAIL" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="USUARIO_CPF">CPF</label>
            <input type="number" class="form-control fr" id="USUARIO_CPF" name="USUARIO_CPF" placeholder="Seu CPF" maxlength="11">
        </div>
        <div class="form-group">
            <label for="USUARIO_SENHA">Senha</label>
            <input type="password" class="form-control fr" id="USUARIO_SENHA" name="USUARIO_SENHA" placeholder="Senha">
        </div>
            <button type="submit" class="btn btn-primary bt">Continuar</button>
    </form>
</section>
<footer style="bottom: 0;">
        <img src="assets/logo.png" alt="logo delta" id='delta-footer' >
        <h2 id='h2-footer'>Delta | </h2>
        <p id='p-footer'> Precisa de ajuda ou suporte técnico? Acesse nossa seção de suporte para obter assistência!</p>
        <div id='div-footer'>
        <a href="{{route('produto.index')}}">Home</a> |
            <a href="">Suporte</a> | 
            <a href="">Termos legais</a> | 
            <a href="">Política de privacidade</a>
        </div>
        
    </footer>

    <!--Script dos icons e do Bootstrap-->
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>