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
                <a href="{{route('tipos.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Novo Tipo de Documento</a>
                <div class="table-responsive text-nowrap">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Ação</th>
                                <th>Título do Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>
                                    <a href="{{route('tipos.edit', $tipo->id)}}" class="btn btn-warning  btn-xs px-2"><i class="fas fa-pen"></i></a>
                                    <a onclick="deleteRegister(this)" href="javascript:void(0)" data-rota="{{route('tipos.delete', $tipo->id)}}" class="btn btn-danger btn-xs px-2 ml-1"><i class="fas fa-trash"></i></a>
                                </td>
                                <td>{{$tipo->titulo}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop