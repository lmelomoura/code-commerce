@extends('app')
@section('content')
    <div class="container">
        <h1>Lista de produtos</h1>
        <p>
            <a href="{{ route('productsCreate') }}"> <img src="{{asset('images/add.png')}}" height="16" width="16" alt="Adicionar novo produto" title="Adicionar novo produto"> Adicionar novo produto</a>
        </p>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Opções</th>
                <th>Ações</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>R${{number_format($product->price, 2, ',', '.')}}</td>
                    <td>
                        @if ($product->featured)
                            <img src="{{asset('images/check.png')}}" height="14" width="14">Destaque&nbsp;
                        @else
                            <img src="{{asset('images/uncheck.png')}}" height="14" width="14">Destaque&nbsp;
                        @endif
                        @if ($product->recommended)
                            <img src="{{asset('images/check.png')}}" height="14" width="14">Recomendado&nbsp;
                        @else
                            <img src="{{asset('images/uncheck.png')}}" height="14" width="14">Recomendado&nbsp;
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('productsDelete',['id'=>$product->id]) }}"> <img src="{{asset('images/trash.png')}}" height="16" width="16" alt="Apagar produto" title="Apagar produto"> </a>
                        <a href="{{ route('productsEdit',['id'=>$product->id]) }}"> <img src="{{asset('images/edit.png')}}" height="16" width="16" alt="Editar produto" title="Editar produto"> </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

