@foreach($categorias as $item)
<ul>
    <li>
<a href="">{{$item->CATEGORIA_NOME}} ({{$item->Produtos->count()}})</a>
</li>
</ul>  
@endforeach