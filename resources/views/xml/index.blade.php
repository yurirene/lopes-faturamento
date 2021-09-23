@extends('template')

@section('title', 'Importar XML')

@section('content_header')
    <h1>Importar XML</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Importar NF-e</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('xml.importar-xml'), 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('industria', 'Industria') !!}
                    {!! Form::select('industria', $industrias, null, ['class' => 'form-control']) !!}
                </div>
                <label>Arquivo</label> <span class="text-danger">*</span>
                <div class="custom-file mb-3">
                    <input id="arquivo" name="arquivos[]" type="file" class="file"  data-show-upload="true" data-show-caption="true" multiple>
                    <label class="custom-file-label" for="arquivo" >Selecione o Arquivo</label>
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