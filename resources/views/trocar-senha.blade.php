@extends('template')

@section('title', 'Trocar Senha')

@section('content_header')
    <h1>Trocar Senha</h1>
@stop
@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('alterar-senha')]) !!}
                <div class="form-group">
                {!! Form::label('senha_antiga', 'Senha Antiga') !!} <span class="text-danger">*</span>
                {!! Form::password('senha_antiga', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Nova Senha') !!} <span class="text-danger">*</span>
                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) !!}
                </div>
                
                    <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop