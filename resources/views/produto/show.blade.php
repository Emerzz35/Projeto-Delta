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
      <a href="#" class="logo"><img src="/assets/logo.png" alt="Logo Delta"> DELTA </a>
      <ul class="navlist">
         <li><a href="home.html" id="pg-atual">Home</a></li>
         <li><a href="#">Comunidade</a></li>
         <li><a href="#">Sobre </a></li>
      </ul>
      <div class="menu-icons">
         <box-icon id="search" name='search' size="2rem" color="white"></box-icon>
         <box-icon id="cart" name='cart' size='2rem' color="white"></box-icon>
         <box-icon id="user" name='user-circle' size='2rem' color="white"></box-icon>
      </div>
      <div class="bx bx-menu" id="menu-icon"></div>
   </header>

   <main>
      <h1>{{$produto->PRODUTO_NOME}}</h1>
      <section class="Produto Container">
         <div class="ProdutoHorizontal row align-items-end">
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

               <P>{{$produto->PRODUTO_DESC}}</P>
               <P>Categoria: {{$produto->Categoria->CATEGORIA_NOME}}</P>
            </div>
        </div>
            <div class="BtFundo">
               <p>Unidades em estoque</p>
               <div class="btVerde"> {{$produto->estoque->PRODUTO_QTD}} </div>
            </div>
         

         <section class="Comprar">
            <p>Comprar {{$produto->PRODUTO_NOME}}</p>
            <div class="BtFundo">
               <P> R$ {{$produto->PRODUTO_PRECO}} </P>
               <div class="btVerde"> + Carrinho </div>
            </div>
         </section>
      </section>
   </main>

   <?php // Outros Produtos 
   ?>

   <section class="Outros">

      <div class="cardall">
         <div class="card-group " id="scrollableDiv">

            @foreach($produtos as $item)
            @if(($item->CATEGORIA_ID == $produto->CATEGORIA_ID) and ($item->PRODUTO_ID <> $produto->PRODUTO_ID))
               <div class="card mb-3 cardon">
                  <div class="row g-0">
                     <div class="col-md-4 card-col">
                        @if($item->Imagens->isNotEmpty())
                        <img src="{{ $item->Imagens->first()->IMAGEM_URL }}" class="img-fluid rounded-start" alt="...">
                        @endif
                     </div>
                     <div class="col-md-5 card-col">
                        <div class="card-body">
                           <h5 class="card-title">{{$item->PRODUTO_NOME}}</h5>
                           <p class="card-text categoria">{{$item->Categoria->CATEGORIA_NOME}}</p>
                        </div>
                     </div>
                     <div class="col-md-3 card-col">
                        <div class="card-preco">
                           <p class="card-text">{{$item->PRODUTO_PRECO}}</p>
                           <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon>
                        </div>
                     </div>
                     @endif
                     @endforeach

                  </div>
               </div>
         </div>
      </div>

      <div class="Categoria">
         <h2>{{$produto->Categoria->CATEGORIA_NOME}}</h2>
         <div class="CategoriaDesc">
            <p>{{$produto->Categoria->CATEGORIA_DESC}}</p>
         </div>
      </div>
   </section>

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