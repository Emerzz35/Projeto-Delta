<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delta Jogos</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
    <link rel="stylesheet" href="/css/main-home.css">
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
        <a href="{{route('produto.index')}}"><box-icon id="search" name='search' size="2rem" color="white"></box-icon></a>
        <a href="{{route('carrinho.show')}}"><box-icon id="cart" name='cart' size='2rem' color="white"></box-icon></a>
        <div class="dropdown" id="dropdownnav">
            <button class="dropdown-toggle" type="button" id="navdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                <box-icon id="user" name='user-circle' size='2rem' color="white"></box-icon>
            </button>
            <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navdrop">  
                @if (Auth::check()) 
                <a href="{{route('profile.edit')}}" class="dropdown-item">Ver perfil</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{route('profile.edit')}}" class="dropdown-item">Faça Login</a>
                <a href="{{ route('register') }}" class="dropdown-item">Registrar</a>
                @endif  
            </div>
        </div>
    </div>
    <div class="bx bx-menu" id="menu-icon"></div>
</header>

<section class="fundoCarrosel">
    <section class="center slider">
        @for ($i = 0; $i < 3; $i++)
        <div class="slide">
            <a href="{{route('produto.show', $produtos[$i]->PRODUTO_ID)}}">
                <img src="{{ $produtos[$i]->Imagens->first()->IMAGEM_URL }}" alt="{{ $produtos[$i]->PRODUTO_NOME }}">
            </a>
        </div>
        @endfor
    </section>

    <div class="carrossel-hover">
        <div id="car1">
            <h2 id="Carrossel-Hover-Titulo">{{ $produtos[0]->PRODUTO_NOME }}</h2>
            <p class="subt" id="Carrossel-Hover-Categoria">{{ $produtos[0]->Categoria->CATEGORIA_NOME }}</p>
            <p id="Carrossel-Hover-Desc">{{ $produtos[0]->PRODUTO_DESC}}</p>
        </div>
        <div id="car2">
            <p id="Carrossel-Hover-Preco">R$ {{ number_format($produtos[0]->PRODUTO_PRECO, 2, ',', '.') }}</p>
            <box-icon name='cart-add' color="white" size="3.5rem" id="carrinho" animation='tada-hover'></box-icon>
        </div>
    </div>
</section>

<div class="filtros">
    <div class="filtro filtro-ativo">Novidades</div>
    <div class="filtro">Ofertas</div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($categorias as $categoria)
            <a class="dropdown-item" href="#">{{$categoria->CATEGORIA_NOME}}</a>
            @endforeach
        </div>
    </div>
</div>

<main>
    <div class="cardall">
        <div class="card-group" id="scrollableDiv">
            @foreach($produtos as $index => $produto)
            <div class="card mb-3 card-item" data-index="{{ $index }}">
                <div class="row g-0">
                    <a href="{{route('produto.show', $produto->PRODUTO_ID)}}" class="col-md-4 card-col">
                        @if($produto->Imagens->isNotEmpty())
                        <img src="{{ $produto->Imagens->first()->IMAGEM_URL }}" class="img-fluid rounded-start" alt="...">
                        @endif
                    </a>
                    <a href="{{route('produto.show', $produto->PRODUTO_ID)}}" class="col-md-5 card-col">
                        <div class="card-body">
                            <h5 class="card-title">{{$produto->PRODUTO_NOME}}</h5>
                            <p class="card-text categoria">{{$produto->Categoria->CATEGORIA_NOME}}</p>
                        </div>
                    </a>
                    <div class="col-md-3 card-col">
                        <div class="card-preco">
                            <p class="card-text">{{$produto->PRODUTO_PRECO}}</p>
                            <a href="{{ route('carrinho.store', $produto) }}">
                                <box-icon name='cart-add' color="white" size="2rem" animation='tada-hover'></box-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card-info">
            <h5 class="card-title" id="info-title">Minecraft</h5>
            <p class="card-text categoria" id="info-category">Sandbox</p>
            <img src="assets/Assets temporarios/minecraft3.webp" alt="" class="img-fluid rounded-start" id="info-image">
            <p class="card-text card-desc" id="info-description">Em Minecraft, você constrói o que quiser em um mundo infinito. Sobreviva, explore e crie com amigos ou sozinho. Uma experiência de jogo única e infinita.</p>
        </div>
    </div>
    <div class="fadeout"></div>
</main>

<!--Script do Slick e do Bootstrap-->
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(".center").slick({
        variableWidth: true,
        dots: false,
        infinite: true,
        centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 3,
        autoplay: true
    });

    $('.center').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        const Titulo = document.getElementById('Carrossel-Hover-Titulo');
        const Categoria = document.getElementById('Carrossel-Hover-Categoria');
        const Desc = document.getElementById('Carrossel-Hover-Desc');
        const Preco = document.getElementById('Carrossel-Hover-Preco');

        if (nextSlide == 0) {
            Titulo.innerHTML = '{{ $produtos[0]->PRODUTO_NOME }}';
            Categoria.innerHTML = '{{ $produtos[0]->Categoria->CATEGORIA_NOME }}';
            Desc.innerHTML = '{{ $produtos[0]->PRODUTO_DESC }}';
            Preco.innerHTML = "R$ {{ number_format($produtos[0]->PRODUTO_PRECO, 2, ',', '.') }}";
        } else if (nextSlide == 1) {
            Titulo.innerHTML = '{{ $produtos[1]->PRODUTO_NOME }}';
            Categoria.innerHTML = '{{ $produtos[1]->Categoria->CATEGORIA_NOME }}';
            Desc.innerHTML = '{{ $produtos[1]->PRODUTO_DESC }}';
            Preco.innerHTML = "R$ {{ number_format($produtos[1]->PRODUTO_PRECO, 2, ',', '.') }}";
        } else if (nextSlide == 2) {
            Titulo.innerHTML = '{{ $produtos[2]->PRODUTO_NOME }}';
            Categoria.innerHTML = '{{ $produtos[2]->Categoria->CATEGORIA_NOME }}';
            Desc.innerHTML = '{{ $produtos[2]->PRODUTO_DESC }}';
            Preco.innerHTML = "R$ {{ number_format($produtos[2]->PRODUTO_PRECO, 2, ',', '.') }}";
        }
    });
</script>
<script type="text/javascript">
    // Script para atualizar card-info no hover do card
    document.querySelectorAll('.card-item').forEach(item => {
        item.addEventListener('mouseover', event => {
            const index = event.currentTarget.dataset.index;
            const produtos = @json($produtos);
            console.log (produtos);
            document.getElementById('info-title').innerText = produtos[index].PRODUTO_NOME;
            document.getElementById('info-description').innerText = produtos[index].PRODUTO_DESC;
            document.getElementById('info-category').innerText = produtos[index].categoria.CATEGORIA_NOME;
            document.getElementById('info-image').src = produtos[index].imagens.length ? produtos[index].imagens[0].IMAGEM_URL : '';
            
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
