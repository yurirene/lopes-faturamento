@extends('template')

@section('title', 'Industrias')

@section('content_header')
    <h1>Industrias</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lista de Industrias</h3>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop
@push('js')

{!! $dataTable->scripts() !!}

@endpush