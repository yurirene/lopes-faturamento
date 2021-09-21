@extends('template')

@section('title', 'Notas')

@section('content_header')
    <h1>Itens :: Nota <b>{{$nota->numero}}</b></h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Itens</b></h3>
            </div>
            <div class="card-body">
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
@endpush