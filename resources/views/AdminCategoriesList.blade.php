<h1>Lista de categorias</h1>
<ul>
    @foreach($categories as $category)
        <li title="{{ $category->description }}"><b>Categoria: </b>{{ $category->name }}:</li>
        <ul>
            <li>
                <b>Descrição:</b> {{ $category->description }}
            </li>
        </ul>
        <br clear="all">
    @endforeach
</ul>
