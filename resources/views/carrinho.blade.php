<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <!-- Cards -->
    @foreach ($itens as $item)
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
    @endforeach

    <!-- barrinha de preço total-->
    <div>
        <!-- Preço Total -->
        <div>
            <p>Total: R$ {{ number_format($precoTotal, 2, ',', '.') }}</p>
        </div>
    </div>

    <!--Barrinha  DropDown endereço e Botão comprar -->
    <form action="" method="post">

        <select name="ENDERECO_NOME" id="ENDERECO_NOME">
            @foreach ($enderecos as $endereco)
                <option value="{{ $endereco->ENDERECO_ID }}">{{ $endereco->ENDERECO_NOME }}</option>
            @endforeach
        </select>
        
        <button type="submit">Comprar</button>  

    </form>

    <a href="{{route('endereco.create')}}">Adicionar novo endereço</a>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>