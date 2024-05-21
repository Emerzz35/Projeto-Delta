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
    <form class="fm">
        <div class="form-group">
            <label for="formGroupExampleInput">Nome</label>
            <input type="text" class="form-control fr" id="formGroupExampleInput" placeholder="Nome completo">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">E-mail</label>
            <input type="text" class="form-control fr" id="formGroupExampleInput2" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">CPF</label>
            <input type="text" class="form-control fr" id="formGroupExampleInput2" placeholder="Seu CPF">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Senha</label>
            <input type="text" class="form-control fr" id="formGroupExampleInput2" placeholder="Senha">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Confirmar senha</label>
            <input type="text" class="form-control fr" id="formGroupExampleInput2" placeholder="Repita a senha">
        </div>
            <button type="button" class="btn btn-primary bt">Continuar</button>
    </form>
</section>
<footer>
        <img src="assets/logo.png" alt="logo delta" id='delta-footer'>
        <h2 id='h2-footer'>Delta | </h2>
        <p id='p-footer'> Precisa de ajuda ou suporte técnico? Acesse nossa seção de suporte para obter assistência!</p>
        <div id='div-footer'>
            <a href="">Home</a> | 
            <a href="">Suporte</a> | 
            <a href="">Termos legais</a> | 
            <a href="">Política de privacidade</a>
        </div>
        
    </footer>
</body>

</html>