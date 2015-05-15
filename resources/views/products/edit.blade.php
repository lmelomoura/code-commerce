@extends('app')
@section('content')
    <div class="container">
        <h1>Editar produto: {{ $product->name }}</h1>

        {!! Form::open(['route' => ['productsUpdate',$product->id], 'method'=>'put']) !!}

        @if ($errors->all())
            <ul class="alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price','Preço:') !!}
            {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('featured','Destaque') !!}
            {!! Form::checkbox('featured',1,$product->featured) !!}
            {!! Form::label('recommended','Recomendado') !!}
            {!! Form::checkbox('recommended',1,$product->recommended) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::button('Cancelar', ['onClick'=>'window.location=\''.route('productsList').'\'', 'class' => 'btn btn-primary ']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection