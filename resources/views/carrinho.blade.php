<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main-carrinho.css">
    <title>Carrinho</title>
</head>

<body>

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
                <a href="{{route('profile.edit')}}" class="dropdown-item" data-toggle="modal" data-target="#updateProfileModal">Faça Login</a>
                <a href="{{ route('register') }}" class="dropdown-item">Registrar</a>
                @endif  
            </div>
        </div>
    </div>
</header>
<div class="container titulo"><h1>Seu Carrinho</h1></div>

   <main class="container">
    <!-- Cards -->
    <div class="card-group scroll">
    @foreach ($itens as $item)
    @if ($item->produto->porcentagem_desconto>=1)
    <!-- Produtos Com desconto -->
    <div class="card mb-3">
    <div class="row g-0">  
        <!-- Imagem  -->
        <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-3 card-col"> 
        @if ($item->Produto->Imagens->isNotEmpty())
        <img src="{{ $item->Produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
        @endif
        </a>

        <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-5 card-col">
        <div class="card-body">
        <!-- Nome  -->
        <h5 class="card-title">{{ $item->Produto->PRODUTO_NOME }}</h5>
        <!-- Categoria  -->
        <p class="card-text categoria"> {{ $item->Produto->Categoria->CATEGORIA_NOME }}</p>
        </div>
        </a>

        <div class="col-md-3 card-col col-3-desconto">
        <div class="card-preco com-desconto">
        <!-- Porcentagem desconto  -->
        <p class="card-text desconto">-{{ number_format($item->produto->porcentagem_desconto, 0, ',', '.') }}%</p>
        <div class="preco-desconto">
        <!-- Preço antes do desconto -->
        <p class="card-text preco-sem-desconto">R$ {{ number_format($item->produto->PRODUTO_PRECO, 2, ',', '.') }}</p>
        <!-- Preço Depois do desconto -->
        <p class="card-text preco-com-desconto" style="margin-bottom: 0 !important;">R$ {{ number_format($item->produto->preco_com_desconto, 2, ',', '.') }}</p>
         <!-- Botão Remover -->
         <a href="{{ route('carrinho.delete', $item->Produto) }}">Remover</a>
        </div>
        </div>
        </div>

        <div class="col-md-1 card-col">
        <div class="Qtd">
        <!-- Quantidade  -->
         <p class="qtd-t">Qnt</p>
        <p class="qtd-p">{{ $item->ITEM_QTD }}</p>

        <!-- Botão Remover unidade -->
        <div class="qtd-bts">
        <a href="{{ route('carrinho.remover', $item->Produto) }}" class="bt-">-</a>
        <!-- Botão Adicionar -->
        @if ( $item->Produto->Estoque->PRODUTO_QTD>0) 
        <a href="{{ route('carrinho.adicionar', $item->Produto) }}" class="bt-add">+</a>
        @else
        <div class="bt-">+</div>
        @endif
        </div>
        </div>
        </div>
    </div>
    </div>
    @else
    <!-- Produtos sem desconto -->
    <div class="card mb-3">
    <div class="row g-0">  
        <!-- Imagem  -->
        <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-3 card-col"> 
        @if ($item->Produto->Imagens->isNotEmpty())
        <img src="{{ $item->Produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
        @endif
        </a>

        <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-6 card-col">
                        <div class="card-body">
        <!-- Nome  -->
        <h5 class="card-title">{{ $item->Produto->PRODUTO_NOME }} </h5>

        <!-- Categoria  -->
        <p class="card-text categoria">{{ $item->Produto->Categoria->CATEGORIA_NOME }}</p>
        </div>
        </a>
        <!-- Preço  -->
        <div class="col-md-2 card-col">
        <div class="card-preco sem-desconto">
        <p class="card-text"> R$ {{ number_format($item->produto->PRODUTO_PRECO, 2, ',', '.') }} </p>
                <!-- Botão Remover -->
                <a href="{{ route('carrinho.delete', $item->Produto) }}">Remover</a>
        </div>
        </div>

        <div class="col-md-1 card-col">
        <div class="Qtd">
        <!-- Quantidade  -->
         <p class="qtd-t">Qnt</p>
        <p class="qtd-p">{{ $item->ITEM_QTD }}</p>

        <!-- Botão Remover unidade -->
        <div class="qtd-bts">
        <a href="{{ route('carrinho.remover', $item->Produto) }}" class="bt-">-</a>
        <!-- Botão Adicionar -->
         @if ( $item->Produto->Estoque->PRODUTO_QTD>0) 
        <a href="{{ route('carrinho.adicionar', $item->Produto) }}" class="bt-add">+</a>
        @else
        <div class="bt-">+</div>
        @endif
        </div>
        </div>
        </div>
    </div>
    </div>
    @endif
    @endforeach
    </div>
    <hr>
    
    <!-- barrinha de preço total-->
        <!-- Preço Total -->
        <div class="total">
            <p class="total-p">Total: R$ {{ number_format($precoTotal, 2, ',', '.') }}</p>
        </div>
        <hr>
 
        <div class="endereco-comprar">
    <!--Barrinha  DropDown endereço e Botão comprar -->
    <form action="{{route('pedido.store')}}" method="post">
        @csrf

        <select name="ENDERECO_NOME" id="ENDERECO_NOME">
            @foreach ($enderecos as $endereco)
            <option value="{{ $endereco->ENDERECO_ID }}">{{ $endereco->ENDERECO_NOME }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="btn btn-success">Comprar</button>
        
    </form>
        </div>
    <a href="{{route('endereco.create')}}">Adicionar novo endereço</a>
    </main>



    <footer>
        <img src="assets/logo.png" alt="logo delta" id='delta-footer'>
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