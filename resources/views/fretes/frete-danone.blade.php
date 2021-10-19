@extends('template')

@section('title', 'Fretes')

@section('content_header')
    <h1>Frete Danone</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                {!! Form::model($frete, ['route' => ['frete-danone.salvar', $frete->id], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('fator', 'Fator de Multiplicação') !!}
                            {!! Form::text('fator', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('frete-danone.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop