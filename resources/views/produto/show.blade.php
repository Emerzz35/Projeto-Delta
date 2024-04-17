<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Inclua os arquivos CSS do Bootstrap -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('node_modules/bootstrap/dist/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<h1>{{$produto->PRODUTO_NOME}}</h1>
<main>

   <?php // Imagem da direita ?>

   @if($produto->Imagens->isNotEmpty())
   <img src="{{ $produto->Imagens->first()->IMAGEM_URL }}" alt="">
   @endif

   <?php // Carrossel ?>

   @foreach($produto->Imagens as $imagem)
   <img src="{{$imagem->IMAGEM_URL}}" alt="">
   @endforeach


   <P>{{$produto->PRODUTO_DESC}}</P>
   <P>Categoria: {{$produto->Categoria->CATEGORIA_NOME}}</P>

   <div class="BtFundo">
      <p>Unidades em estoque</p>
      <div class="btVerde"> {{$produto->estoque->PRODUTO_QTD}} </div>
   </div>
</main>
<section class="Comprar">
   <p>Comprar {{$produto->PRODUTO_NOME}}</p>
   <div class="BtFundo">
      <P> R$ {{$produto->PRODUTO_PRECO}} </P>
      <div class="btVerde"> + Carrinho </div>
   </div>
</section>

<?php // Outros Produtos ?>

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

<script src="{{ asset('node_modules/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>