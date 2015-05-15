@extends('app')
@section('content')
    <div class="container">
        <h1>Lista de categorias</h1>
        <p>
            <a href="{{ route('categoriesCreate') }}"> <img src="{{asset('images/add.png')}}" height="16" width="16" alt="Adicionar nova categoria" title="Adicionar nova categoria"> Adicionar nova categoria</a>
        </p>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <a href="{{ route('categoriesDelete',['id'=>$category->id]) }}"> <img src="{{asset('images/trash.png')}}" height="16" width="16" alt="Apagar categoria" title="Apagar categoria"> </a>
                        <a href="{{ route('categoriesEdit',['id'=>$category->id]) }}"> <img src="{{asset('images/edit.png')}}" height="16" width="16" alt="Editar categoria" title="Editar categoria"> </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection