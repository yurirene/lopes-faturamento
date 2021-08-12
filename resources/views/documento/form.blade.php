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
                {!! Form::select('tipo', ['' => ''], null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                {!! Form::label('referencia', 'E-mail para Login') !!} <span class="text-danger">*</span>
                {!! Form::text('referencia', null, ['class' => 'form-control is_referencia', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>

                <label>Arquivo</label>
                <div class="custom-file mb-3">
                    {!! Form::file('arquivo', null, ['class' => 'custom-file-input', 'required' => 'required']) !!}
                    <label class="custom-file-label">Selecione o Arquivo</label>
                    @if (isset($documento) && $documento->arquivo)
                        <br/><a href="/storage/{{ $documento->arquivo }}" target="_blank" class="mt-2 d-block"><i class="fas fa-external-link-alt"></i> Visualizar Arquivo</a>
                    @endif
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