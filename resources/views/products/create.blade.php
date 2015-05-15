@extends('app')
@section('content')
    <div class="container">
        <h1>Adicionar produto</h1>

        {!! Form::open(['route' => 'productsStore','method' => 'post']) !!}

        @if ($errors->all())
            <ul class="alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            {!! Form::label('name','Nome:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price','Preço:') !!}
            {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description','Descrição:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('featured','Destaque') !!}
            {!! Form::checkbox('featured',1) !!}
            {!! Form::label('recommended','Recomendado') !!}
            {!! Form::checkbox('recommended',1) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary']) !!}
            {!! Form::button('Cancelar', ['onClick'=>'window.location=\''.route('productsList').'\'', 'class' => 'btn btn-primary ']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection