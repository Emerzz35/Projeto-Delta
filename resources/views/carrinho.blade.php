<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
    <link rel="stylesheet" href="css/main-carrinho.css">
    <title>Document</title>
</head>

<body>

    <!-- Cards -->
    @foreach ($itens as $item)
    @if ($item->produto->porcentagem_desconto>=1)
    <!-- Produtos Com desconto -->
    <div>
        <!-- Imagem  -->
        @if ($item->Produto->Imagens->isNotEmpty())
        <img src="{{ $item->Produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
        @endif
        <!-- Nome  -->
        {{ $item->Produto->PRODUTO_NOME }}
        <!-- Categoria  -->
        {{ $item->Produto->Categoria->CATEGORIA_NOME }}
        <!-- Porcentagem desconto  -->
        -{{ number_format($item->produto->porcentagem_desconto, 0, ',', '.') }}%
        <!-- Preço antes do desconto -->
        R$ {{ number_format($item->produto->PRODUTO_PRECO, 2, ',', '.') }}
        <!-- Preço Depois do desconto -->
        R$ {{ number_format($item->produto->preco_com_desconto, 2, ',', '.') }}
        <!-- Quantidade  -->
        {{ $item->ITEM_QTD }}
        <!-- Botão Remover -->
        <a href="{{ route('carrinho.delete', $item->Produto) }}">Remover</a>
        <!-- Botão Remover unidade -->
        <a href="{{ route('carrinho.remover', $item->Produto) }}">-</a>
        <!-- Botão Adicionar -->
        <a href="{{ route('carrinho.adicionar', $item->Produto) }}">+</a>
    </div>
    @else
    <!-- Produtos sem desconto -->
    <div>
        <!-- Imagem  -->
        @if ($item->Produto->Imagens->isNotEmpty())
        <img src="{{ $item->Produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
        @endif
        <!-- Nome  -->
        {{ $item->Produto->PRODUTO_NOME }}
        <!-- Categoria  -->
        {{ $item->Produto->Categoria->CATEGORIA_NOME }}
        <!-- Preço  -->
        {{ $item->Produto->PRODUTO_PRECO }}
        <!-- Quantidade  -->
        {{ $item->ITEM_QTD }}
        <!-- Botão Remover -->
        <a href="{{ route('carrinho.delete', $item->Produto) }}">Remover</a>
        <!-- Botão Remover unidade -->
        <a href="{{ route('carrinho.remover', $item->Produto) }}">-</a>
        <!-- Botão Adicionar -->
        <a href="{{ route('carrinho.adicionar', $item->Produto) }}">+</a>
    </div>
    @endif
    @endforeach
    
    <!-- barrinha de preço total-->
    <div>
        <!-- Preço Total -->
        <div>
            <p>Total: R$ {{ number_format($precoTotal, 2, ',', '.') }}</p>
        </div>
    </div>
    
    <!--Barrinha  DropDown endereço e Botão comprar -->
    <form action="{{route('pedido.store')}}" method="post">
        @csrf

        <select name="ENDERECO_NOME" id="ENDERECO_NOME">
            @foreach ($enderecos as $endereco)
            <option value="{{ $endereco->ENDERECO_ID }}">{{ $endereco->ENDERECO_NOME }}</option>
            @endforeach
        </select>
        
        <button type="submit">Comprar</button>
        
    </form>

    <a href="{{route('endereco.create')}}">Adicionar novo endereço</a>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
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