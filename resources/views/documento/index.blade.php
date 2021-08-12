@extends('template')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Documentos</h3>
            </div>
            <div class="card-body">
                @cannot('is_admin')
                <a href="{{route('documentos.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Enviar Documento</a>
                @endcannot
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
