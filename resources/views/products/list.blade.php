@extends('app')
@section('content')
    <div class="container">
        <h1>Lista de produtos</h1>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>R${{number_format($product->price, 2, ',', '.')}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

