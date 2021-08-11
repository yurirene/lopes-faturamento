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
                <h3 class="card-title">Lista de Áreas de Atuação</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
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
