@extends('template')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                @if (!isset($documento))
                {!! Form::open(['url' => route('documentos.store'), 'files' => true]) !!}
                @else
                {!! Form::model($documento, ['route' => ['documentos.update', $documento->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif
                <div class="form-group">
                {!! Form::label('tipo', 'Tipo') !!} <span class="text-danger">*</span>
                {!! Form::select('tipo', $tipos, null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                {!! Form::label('referencia', 'Mês de Referência') !!} <span class="text-danger">*</span>
                {!! Form::text('referencia', null, ['class' => 'form-control is_referencia', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => '01/2000']) !!}
                </div>

                <label>Arquivo</label> <span class="text-danger">*</span>
                <div class="custom-file mb-3">
                    {!! Form::file('arquivo', ['class' => 'custom-file-input', 'required' => 'required', 'id' => 'arquivo', 'data-browse' => 'Selecionar']) !!}
                    <label class="custom-file-label" for="arquivo" >Selecione o Arquivo</label>
                </div>

                <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('documentos.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop