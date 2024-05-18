@foreach($itens as $item)
    <div>
    <!-- Imagem  --> 
      @if($item->Produto->Imagens->isNotEmpty())
        <img src="{{ $item->Produto->Imagens->first()->IMAGEM_URL }}" alt="" id="ImagemDireita">
      @endif
    <!-- Nome  -->
      {{$item->Produto->PRODUTO_NOME}}
    <!-- Categoria  -->
      {{$item->Produto->Categoria->CATEGORIA_NOME}}
    <!-- Preço  -->
      {{$item->Produto->PRODUTO_PRECO}}
    <!-- Quantidade  -->
      {{$item->ITEM_QTD}}
    <!-- Botão Remover -->
      <a href="{{route('carrinho.delete', $item->Produto)}}">Remover</a>
    <!-- Botão Remover unidade -->
      <a href="{{route('carrinho.remover', $item->Produto)}}">-</a>
    <!-- Botão Adicionar -->
    <a href="">+</a>
     </div>
@endforeach