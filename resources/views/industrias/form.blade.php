@extends('template')

@section('title', 'Notas')

@section('content_header')
    <h1>Notas</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                @if(!isset($industria))
                {!! Form::open(['route' => ['industrias.store'], 'method' => 'POST']) !!}
                @else                
                {!! Form::model($industria, ['route' => ['industrias.update', $industria->id], 'method' => 'PUT']) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('cnpj', 'CNPJ') !!}
                            {!! Form::text('cnpj', null, ['class' => 'form-control']) !!}
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('razao_social', 'Razão Social') !!}
                            {!! Form::text('razao_social', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('cidade', 'Cidade') !!}
                            {!! Form::text('cidade', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('industrias.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop