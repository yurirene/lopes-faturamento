@extends('template')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                @if (!isset($empresa))
                {!! Form::open(['url' => route('empresa.store'), 'files' => true]) !!}
                @else
                {!! Form::model($empresa, ['route' => ['empresa.update', $empresa->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif
                <div class="form-group">
                {!! Form::label('razao_social', 'Razão Social') !!} <span class="text-danger">*</span>
                {!! Form::text('razao_social', null, ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>

                <div class="form-group">
                {!! Form::label('email', 'E-mail para Login') !!} <span class="text-danger">*</span>
                {!! Form::email('email', isset($empresa) ? $empresa->usuario->email : null, ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Senha para Login') !!} <span class="text-danger">*</span>
                    @if (!isset($empresa))
                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    @endif                    
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