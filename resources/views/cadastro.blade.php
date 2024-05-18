<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/main-cadastro.css">
</head>

<body class="text-md">
    <header>
        <a href="#" class="logo"><img src="/assets/logo.png" alt="Logo Delta"> DELTA </a>
        <ul class="navlist">
            <li><a href="home.html">Home</a></li>
            <li><a href="#">Comunidade</a></li>
            <li><a href="#" id="pg-atual">Sobre <span class="sr-only">página atual</span></a></li>
        </ul>
        <div class="menu-icons">
            <box-icon id="search" name='search' size="2rem" color="white"></box-icon>
            <box-icon id="cart" name='cart' size='2rem' color="white"></box-icon>
            <box-icon id="user" name='user-circle' size='2rem' color="white"></box-icon>
        </div>
        <div class="bx bx-menu" id="menu-icon"></div>
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
            <input type="text" class="form-control fr" id="USUARIO_CPF" name="USUARIO_CPF" placeholder="Seu CPF">
        </div>
        <div class="form-group">
            <label for="USUARIO_SENHA">Senha</label>
            <input type="password" class="form-control fr" id="USUARIO_SENHA" name="USUARIO_SENHA" placeholder="Senha">
        </div>
            <button type="submit" class="btn btn-primary bt">Continuar</button>
    </form>
</section>
</body>

</html>