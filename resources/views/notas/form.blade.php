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
                
                <div class="row">
                    <div class="form-group col-md-4">
                        {!! Form::label('industria', 'Industria') !!}
                        {!! Form::text('industria', $nota->industria->razao_social, ['class' => 'form-control', 'disabled' => 'true']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('cliente', 'Cliente') !!}
                        {!! Form::text('cliente', $nota->cliente->razao_social, ['class' => 'form-control', 'disabled' => 'true']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('numero', 'Nº da NF') !!}
                        {!! Form::text('numero', $nota->numero, ['class' => 'form-control', 'disabled' => 'true']) !!}
                    </div>
                </div>
                {!! Form::model($nota, ['route' => ['notas.update', $nota->id], 'method' => 'PUT']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pedido_cliente', 'Pedido Cliente') !!}
                            {!! Form::text('pedido_cliente', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('cte', 'Cte') !!}
                            {!! Form::text('cte', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('chegada', 'Data da Chegada') !!}
                            {!! Form::text('chegada', $nota->chegada ? $nota->chegada->format('d/m/Y') : null, ['class' => 'form-control isDate', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('chegada_porto', 'Data da Chegada no Porto') !!}
                            {!! Form::text('chegada_porto', $nota->chegada_porto ? $nota->chegada_porto->format('d/m/Y') : null, ['class' => 'form-control isDate', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('placa', 'Placa') !!}
                            {!! Form::text('placa', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('transportadora', 'Transportadora') !!}
                            {!! Form::text('transportadora', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('data_entrega', 'Data da Entrega') !!}
                            {!! Form::text('data_entrega', $nota->data_entrega ? $nota->data_entrega->format('d/m/Y') : null, ['class' => 'form-control isDate', 'autocomplete' => 'off']) !!}
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('data_reentrega', 'Data da Reentrega') !!}
                            {!! Form::text('data_reentrega', $nota->data_reentrega ? $nota->data_reentrega->format('d/m/Y') : null, ['class' => 'form-control isDate', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('canhoto', 'Canhoto') !!}
                            {!! Form::select('canhoto', [0 => 'Aguardando', 1 => 'Ok'], $nota->canhoto ,['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nf_devolucao', 'NF de Devolução') !!}
                            {!! Form::text('nf_devolucao', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('observacao', 'Observação') !!}
                            {!! Form::textarea('observacao', null, ['class' => 'form-control', 'maxlength' => "200", 'rows' => 3, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('notas.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop