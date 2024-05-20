<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main-cadastro.css">
</head>
<body>
<form class="fm" method="POST" action="{{ route('endereco.store') }}">
        @csrf

        <div class="form-group">
            <label for="ENDERECO_NOME">Apelido do Endereço</label>
            <input type="text" class="form-control fr" id="ENDERECO_NOME" name="ENDERECO_NOME" placeholder="Apelido do Endereço">
        </div>
        <div class="form-group">
            <label for="ENDERECO_LOGRADOURO">Logradouro</label>
            <input type="text" class="form-control fr" id="ENDERECO_LOGRADOURO" name="ENDERECO_LOGRADOURO" placeholder="Logradouro">
        </div>
        <div class="form-group">
            <label for="ENDERECO_NUMERO">Numero</label>
            <input type="text" class="form-control fr" id="ENDERECO_NUMERO" name="ENDERECO_NUMERO" placeholder="Numero">
        </div>
        <div class="form-group">
            <label for="ENDERECO_COMPLEMENTO">Complemento</label>
            <input type="text" class="form-control fr" id="ENDERECO_COMPLEMENTO" name="ENDERECO_COMPLEMENTO" placeholder="Complemento">
        </div>
        <div class="form-group">
            <label for="ENDERECO_CEP">CEP</label>
            <input type="text" class="form-control fr" id="ENDERECO_CEP" name="ENDERECO_CEP" placeholder="CEP">
        </div>
        <div class="form-group">
            <label for="ENDERECO_CIDADE">Cidade</label>
            <input type="text" class="form-control fr" id="ENDERECO_CIDADE" name="ENDERECO_CIDADE" placeholder="Cidade">
        </div>
        <div class="form-group">
            <label for="ENDERECO_ESTADO">Estado</label>
            <input type="text" class="form-control fr" id="ENDERECO_ESTADO" name="ENDERECO_ESTADO" placeholder="Estado" maxlength="2">
        </div>
            <button type="submit" class="btn btn-primary bt">Adicionar Endereço</button>
    </form>
</body>
</html>