<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{$produto->PRODUTO_NOME}}</title>
   <link rel="icon" type="image/x-icon" href="/assets/logo.png">
   <!--Bootstrap-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <link rel="stylesheet" type="text/css" href="/slick/slick.css">
   <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
   <link rel="stylesheet" href="/css/main-show.css">
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

   <main>
      <div class="FundoH1">
      <h1>{{$produto->PRODUTO_NOME}}</h1>
      </div>
      <section class="Produto Container">
         <div class="ProdutoHorizontal row">
            <?php // Carrossel 
            ?>
            <section class="single-item slider col-sm-8">
               @foreach($produto->Imagens as $imagem)
               @if($produto->Imagens->isNotEmpty())
               <div class="">
                  <img src="{{$imagem->IMAGEM_URL}}" alt="">
               </div>
               @endif
               @endforeach
            </section>
            <?php // Imagem da direita 
            ?>
            <div class="ProdutoVertical col-sm-4">
               @if($produto->Imagens->isNotEmpty())
               <img src="{{ $produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
               @endif

               <P class="ProdutoDesc">{{$produto->PRODUTO_DESC}}</P>
               <P>Categoria: <a href=""> {{$produto->Categoria->CATEGORIA_NOME}} </a></P>
            </div>
        </div>
            <div class="BtFundo">
               <p>Unidades em estoque</p>
               <div class="btVerde"> {{$produto->estoque->PRODUTO_QTD}} </div>
            </div>
         


      </section>
      @if ($produto->porcentagem_desconto>=1)
      <section class="Comprar">
        <p class="Titulo-Comprar">Comprar {{$produto->PRODUTO_NOME}}</p>
        <div class="card-preco comprar-desconto">
      <p class="card-text desconto">-{{ number_format($produto->porcentagem_desconto, 0, ',', '.') }}%</p>
                            <div class="preco-desconto">
                            <p class="card-text preco-sem-desconto">R$ {{ number_format($produto->PRODUTO_PRECO, 2, ',', '.') }}</p>
                            <p class="card-text preco-com-desconto">R$ {{ number_format($produto->preco_com_desconto, 2, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('carrinho.store',$produto)}}" class="btVerde btComprar">
                                <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon>
                            </a>
        </div>
         </section>
         @else
         <section class="Comprar">
         <p class="Titulo-Comprar">Comprar {{$produto->PRODUTO_NOME}}</p>
            <div class="BtFundo">
               <P> R$ {{$produto->PRODUTO_PRECO}} </P>
               <a class="btVerde" href="{{ route('carrinho.store',$produto)}}"> <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon> </a>
            </div>
            </section>
            @endif
   

   <?php // Outros Produtos 
   ?>
   <div class="FundoH1">
<h2>Outros produtos da categoria: <a href=""> {{$produto->Categoria->CATEGORIA_NOME}} </a></h2>
   </div>  
<section class="Outros">
     
      <div class="cardall">
         <div class="card-group scroll" id="scrollableDiv">
            

            @foreach($produtos as $index => $item)
            @if(($item->CATEGORIA_ID == $produto->CATEGORIA_ID))
            @if ($item->porcentagem_desconto>=1) 
            <div class="card mb-3 card-item" data-index="{{ $index }}">
                <div class="row g-0">
                    <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-4 card-col">
                        @if($item->Imagens->isNotEmpty())
                            <img src="{{ $item->Imagens->first()->IMAGEM_URL }}" class="img-fluid rounded-start" alt="{{ $item->PRODUTO_NOME }}">
                        @endif
                    </a>
                    <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-5 card-col col-5-desconto">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->PRODUTO_NOME}}</h5>
                            <p class="card-text categoria">{{$item->Categoria->CATEGORIA_NOME}}</p>
                        </div>
                    </a>
                    <div class="col-md-3 card-col col-3-desconto">
                        <div class="card-preco">
                        <p class="card-text desconto">-{{ number_format($item->porcentagem_desconto, 0, ',', '.') }}%</p>
                            <div class="preco-desconto">
                            <p class="card-text preco-sem-desconto">R$ {{ number_format($item->PRODUTO_PRECO, 2, ',', '.') }}</p>
                            <p class="card-text preco-com-desconto">R$ {{ number_format($item->preco_com_desconto, 2, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('carrinho.store',$item)}}">
                                <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else 
        <div class="card mb-3 card-item" data-index="{{ $index }}">
                <div class="row g-0">
                    <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-4 card-col">
                        @if($item->Imagens->isNotEmpty())
                            <img src="{{ $item->Imagens->first()->IMAGEM_URL }}" class="img-fluid rounded-start" alt="{{ $item->PRODUTO_NOME }}">
                        @endif
                    </a>
                    <a href="{{route('produto.show', $item->PRODUTO_ID)}}" class="col-md-5 card-col">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->PRODUTO_NOME}}</h5>
                            <p class="card-text categoria">{{$item->Categoria->CATEGORIA_NOME}}</p>
                        </div>
                    </a>
                    <div class="col-md-3 card-col">
                        <div class="card-preco">
                            <p class="card-text">R$ {{ number_format($item->PRODUTO_PRECO, 2, ',', '.') }}</p>
                            <a href="{{ route('carrinho.store',$item)}}">
                                <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
                     @endif
                     @endforeach

                  
         </div>
      </div>

      <div class="Categoria">
         <h2>{{$produto->Categoria->CATEGORIA_NOME}}</h2>
         <div class="CategoriaDesc">
            <p>{{$produto->Categoria->CATEGORIA_DESC}}</p>
         </div>
      </div>
   </section>
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
   <!--Script do Slick e do Bootstrap-->
   <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
   <script src="/slick/slick.js" type="text/javascript" charset="utf-8"></script>
   <script type="text/javascript">
      $('.single-item').slick({
         dots: true
      })
   </script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>