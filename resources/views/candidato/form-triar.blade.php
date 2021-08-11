@extends('restrito.template')

@section('title', 'Candidato::Triar')

@section('content_header')
    <h1>Candidato::Triar</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulário de Triagem</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{Form::model($candidato, ['route' => ['restrito.candidato.atualizar', $candidato->id], 'method' => 'put'])}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        {{ Form::label('nome', 'Nome') }}
                        {{Form::text('nome', null, ['class'=>'form-control', 'disabled' => 'disabled']);}}
                    </div>
                    <div class="col-md-6 form-group">
                        {{ Form::label('email', 'E-mail') }}
                        {{Form::text('email', null, ['class'=>'form-control', 'disabled' => 'disabled']);}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        {{ Form::label('data_nascimento', 'Data de Nascimento') }}
                        {{Form::text('data_nascimento', null, ['class'=>'form-control', 'disabled' => 'disabled']);}}
                    </div>
                    <div class="col-md-6 form-group">
                        {{ Form::label('telefone', 'Telefone') }}
                        {{Form::text('telefone', null, ['class'=>'form-control', 'disabled' => 'disabled']);}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        {{ Form::label('encaminhamento', 'Encaminhamento') }}
                        {{Form::select('encaminhamento', [1 => 'Normal', 2 => 'Destaque', 3 => 'Bloqueio'], 1, ['class'=>'form-control']);}}
                    </div>
                    <div class="col-md-6 form-group">
                        {{ Form::label('observacao', 'Observação') }}
                        {{Form::textarea('observacao', null, ['class'=>'form-control', 'rows' => '3']);}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('areas_atuacao[]', 'Áreas de Atuação') }}
                            {{Form::select('areas_atuacao[]', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'isSelect2  form-control', 'multiple' => 'multiple']);}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('tags[]', 'Tags') }}
                            {{Form::select('tags[]', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'isSelect2  form-control', 'multiple' => 'multiple']);}}
                        </div>
                    </div>
                </div>
                {{Form::submit('Concluir Triagem', ['class'=>'btn btn-primary']);}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Currículo</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
               <iframe src="https://google.com" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')


@endpush
