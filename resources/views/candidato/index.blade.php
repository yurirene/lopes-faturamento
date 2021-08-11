@extends('restrito.template')

@section('title', 'Início')

@section('content_header')
    <h1>Início</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Candidatos</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card">
                    <div class="card-header py-2 px-3">
                        <i class="fas fa-filter"></i> Filtros
                    </div>

                        <div class="card-body py-2 px-3 text-xs">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group input-group-sm">
                                        {!! Form::label('area_atauacao', 'Áreas de Atuação') !!}
                                        <div class="input-group-append" style ="width: inherit";>
                                            {!! Form::select('area_atuacao', $areas_atuacao, null, ['class' => 'form-control isSelect2', 'required' => 'required', 'id' => 'atuacao', 'multiple' => 'multiple']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group input-group-sm">
                                        {!! Form::label('tags', 'Tags') !!}
                                        {!! Form::select('tags', $tags, null, ['class' => 'form-control isSelect2', 'required' => 'required', 'id' => 'tags', 'multiple' => 'multiple']) !!}
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
                <div class="table-responsive text-nowrap">
                    {{ $dataTable->table() }}
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

    const table = $('#candidatodatatable-table');
    
    table.on('preXhr.dt', function(e, settings, data){
        data.atuacao = $('#atuacao').val();
        data.tags = $('#tags').val();
    });

    $('#filtrar').on('click', function (){
        table.DataTable().ajax.reload();
        return false;
    });

    $('#resetar').on('click', function (){
        $('#atuacao').val(null).trigger('change');
        $('#tags').val(null).trigger('change');
        table.DataTable().ajax.reload();
        return false;
    });
</script>

@endpush
