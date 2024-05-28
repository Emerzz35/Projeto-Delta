<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main-pedidos.css">
</head>
<!-- Move isso aqui pro arquivo .css -->
<style>
    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
        display: flex;
        width: 100%;
        flex-direction: row;
        align-content: center;
        justify-content: space-between;
        align-items: center;
        text-align: left;
    }

    p {
        margin-bottom: 0;
    }
</style>

<body>
   
    <main>
        <div class="Titulo container">
    <h1> Ultimos pedidos</h1>
    </div>
        <!-- Acordions de pedido -->
        <div class="container mt-5 main">
            <div class="accordion scroll" id="accordionExample">
                @foreach ($pedidos as $pedido)
                <!-- Acordion fechado -->
                <div class="card pedido">
                    <div class="card-header" id="heading{{ $pedido->PEDIDO_ID }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link accordion-button @if (!$loop->first) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{ $pedido->PEDIDO_ID }}" aria-expanded="@if ($loop->first) true @else false @endif" aria-controls="collapse{{ $pedido->PEDIDO_ID }}">
                                <div>
                                    <!-- ID do pedio -->
                                    <P>Pedido #{{ $pedido->PEDIDO_ID }}</P>
                                    <!-- Endereço Completo -->
                                    <P>{{$pedido->endereco->ENDERECO_NOME}} -
                                        {{ $pedido->endereco->ENDERECO_LOGRADOURO }}
                                        {{ $pedido->endereco->ENDERECO_NUMERO }}
                                    </P>
                                    <!-- Data -->
                                    <p>{{$pedido->PEDIDO_DATA}}</p>
                                </div>
                                <div>
                                    <p>Status</p>
                                    <p>{{$pedido->pedidostatus->STATUS_DESC}}</p>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $pedido->PEDIDO_ID }}" class="collapse @if ($loop->first) show @endif" aria-labelledby="heading{{ $pedido->PEDIDO_ID }}" data-parent="#accordionExample">
                        <div class="card-body">
                            <!-- Acordion aberto -->
                            <h3>Produtos</h3>
                            <hr>
                            <!-- Cards de produto -->
                            <div class="cardall scroll">
                                <div class="card-group scroll" id="scrollableDiv">
                                    @foreach($pedido->pedidoitem as $index => $produto)

                                    <div class="card mb-3 card-item" data-index="{{ $index }}">
                                        <div class="row g-0">
                                            <a href="{{route('produto.show', $produto->produto->PRODUTO_ID)}}" class="col-md-4 card-col">
                                                @if($produto->produto->Imagens->isNotEmpty())
                                                <img src="{{ $produto->produto->Imagens->first()->IMAGEM_URL }}" class="img-fluid rounded-start" alt="{{ $produto->produto->PRODUTO_NOME }}">
                                                @endif
                                            </a>
                                            <a href="{{route('produto.show', $produto->produto->PRODUTO_ID)}}" class="col-md-5 card-col">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$produto->produto->PRODUTO_NOME}}</h5>
                                                    <p class="card-text categoria">
                                                        {{$produto->produto->Categoria->CATEGORIA_NOME}}
                                                    </p>
                                                </div>
                                            </a>
                                            <div class="col-md-2 card-col">
                                                <div class="card-preco">
                                                    <p class="card-text">R$
                                                        {{ number_format($produto->produto->PRODUTO_PRECO, 2, ',', '.') }}
                                                    </p>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-1 card-col ">
                                                <div class="qtd">
                                               <p> {{$produto->ITEM_QTD}}</p>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="Total container">
                            <h4>Valor Total:</h4>
                            <p>R$ {{ number_format($pedido->preco_total, 2, ',', '.') }}</p>                                          
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
