@extends('restrito.template')

@section('title', 'Início')

@section('content_header')
    <h1>Candidato</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário Candidato</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{Form::model($candidato, ['route' => ['restrito.candidato.atualizar', $candidato->id], 'method' => 'put'])}}
                    <div class="form-group">
                        {{ Form::label('tags[]', 'Tags') }}
                        {{Form::select('tags[]', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'isSelect2 form-control', 'multiple' => 'multiple']);}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('areas_atuacao[]', 'Áreas de Atuação') }}
                        {{Form::select('areas_atuacao[]', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'isSelect2  form-control', 'multiple' => 'multiple']);}}
                    </div>
                    {{Form::submit('Salvar', ['class'=>'btn btn-primary']);}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop

@push('js')


@endpush
