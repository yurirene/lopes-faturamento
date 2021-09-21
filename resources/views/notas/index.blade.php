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
                <h3 class="card-title">Lista de Notas</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-2 px-3">
                                <i class="fas fa-filter"></i> Filtros
                            </div>
    
                            <div class="card-body py-2 px-3 text-xs">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group input-group-sm">
                                            {!! Form::label('industrias', 'Industrias') !!}
                                            {!! Form::select('industrias', $industrias, null, ['class' => 'form-control isSelect2', 'required' => 'required', 'id' => 'industria', 'multiple' => 'multiple']) !!}
                                        </div>
                                        <div class="form-group input-group-sm">
                                            {!! Form::label('clientes', 'Clientes') !!}
                                            {!! Form::select('clientes', $clientes, null, ['class' => 'form-control isSelect2', 'required' => 'required', 'id' => 'cliente', 'multiple' => 'multiple']) !!}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group input-group-sm">
                                            {!! Form::label('periodo', 'Período') !!}
                                            <div class="input-group">
                                                {!! Form::text('periodo', null, ['class' => 'form-control isDateRange', 'id'=>'periodo', 'autocomplete' => 'off']) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm" type="button" id="filtrar"><i class="fas fa-filter"></i> Filtrar</button>
                                    </div>
                                    <div class="form-group ml-2">
                                        <button class="btn btn-danger btn-sm" type="button" id="resetar"><i class="fas fa-eraser"></i> Limpar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive text-nowrap">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@push('js')

{!! $dataTable->scripts() !!}
<script>
    const table = $('#notas-table');

    table.on('preXhr.dt', function(e, settings, data){
        data.industria = $('#industria').val();
        data.cliente = $('#cliente').val();
        data.periodo = $('#periodo').val();
    });

    $('#filtrar').on('click', function (){
        table.DataTable().ajax.reload();
        return false;
    });

    $('#resetar').on('click', function (){
        $('#industria').val(null).trigger('change');
        $('#cliente').val(null).trigger('change');
        $('#periodo').val('');
        table.DataTable().ajax.reload();
        return false;
    });

</script>

@endpush

@push('css')
<style>
    .select2-selection__rendered {
        line-height: 20px !important;
    }
    .select2-container .select2-selection--single {
        height: 33px !important;
    }
    .select2-container .select2-selection--multiple {
        height: 33px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }

    .input-group-sm .form-control {
        height: calc(2rem + 1px);
    }
</style>
@endpush