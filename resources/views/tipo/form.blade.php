@extends('template')

@section('title', 'Tipo de Documentos')

@section('content_header')
    <h1>Tipo de Documentos</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                @if (!isset($tipo))
                {!! Form::open(['url' => route('tipos.store'), 'files' => true]) !!}
                @else
                {!! Form::model($tipo, ['route' => ['tipos.update', $tipo->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif

                <div class="form-group">
                {!! Form::label('titulo', 'Título do Documento') !!} <span class="text-danger">*</span>
                {!! Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                    <a href="{{ route('empresa.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop