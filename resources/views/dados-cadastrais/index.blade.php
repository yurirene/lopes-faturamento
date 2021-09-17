@extends('template')

@section('title', 'Dados Cadastrais')

@section('content_header')
    <h1>Dados Cadastrais</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Produtos</h3>
            </div>
            <div class="card-body">                
                <a href="{{route('dados-cadastrais.importar')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Importar Planilha</a>

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


@endpush
