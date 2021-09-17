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
                {!! Form::open(['url' => route('dados-cadastrais.importar-planilha'), 'files' => true]) !!}
                <label>Arquivo</label> <span class="text-danger">*</span>
                <div class="custom-file mb-3">
                    {!! Form::file('arquivo', ['class' => 'custom-file-input', 'required' => 'required', 'id' => 'arquivo', 'data-browse' => 'Selecionar']) !!}
                    <label class="custom-file-label" for="arquivo" >Selecione o Arquivo</label>
                </div>
                
                <div class="form-group">
                {!! Form::button("<i class='fas fa-file-import'></i> Importar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('dados-cadastrais.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop