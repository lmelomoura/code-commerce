<h1>Lista de categorias</h1>
<ul>
@foreach($categories as $category)
    <li>{{ $category->name }}: {{ $category->description }}</li>
@endforeach
</ul>
