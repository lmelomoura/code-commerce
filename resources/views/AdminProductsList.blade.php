<h1>Lista de produtos</h1>
<ul>
    @foreach($products as $product)
        <li><b>Produto:</b> {{ $product->name }}</li>
        <ul>
            <li><b>Descrição:</b> {{ $product->description }}</li>
            <li><b>Preço:</b> {{ $product->price }}</li>
        </ul>
    @endforeach
</ul>
