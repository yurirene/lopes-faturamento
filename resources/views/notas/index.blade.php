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
                                            {!! Form::label('periodo', 'Período de Emissão') !!}
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
<div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="modal_data" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_data">Alterar data de <b id="titulo_modal"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <form id="formulario_modal" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label id="label_modal"></label>
                            <input type="text" name="date" class="form-control isDate" autocomplete="off" required>
                        </div>
                        <input type='hidden' name="ids" id="ids" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-block'></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Salvar</button>
                    </div>
                </form>
           
        </div>
    </div>
</div>

<div class="modal fade" id="modal_viagem" tabindex="-1" aria-labelledby="modal_viagem" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_viagem">Alterar Nº da Viagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <form method="post" action="{{route('notas.numero-viagem')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label id="">Nº da Viagem</label>
                            <input type="text" name="numero" class="form-control" autocomplete="off" required>
                        </div>
                        <input type='hidden' name="ids_viagens" id="ids_viagens" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-block'></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Salvar</button>
                    </div>
                </form>
           
        </div>
    </div>
</div>
<div class="modal fade" id="modal_placa" tabindex="-1" aria-labelledby="modal_placa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_placa">Alterar Nº da Placa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <form method="post" action="{{route('notas.numero-placa')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label id="">Nº da Placa</label>
                            <input type="text" name="numero" class="form-control" autocomplete="off" required>
                            <label id="">Nome da Transportadora</label>
                            <input type="text" name="nome" class="form-control" autocomplete="off" required>
                        </div>
                        <input type='hidden' name="ids_placa" id="ids_placa" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class='fas fa-block'></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Salvar</button>
                    </div>
                </form>
           
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
    $(document).on('click','#checkbox-master', function(){
        var checkboxs = [];
        var botao = '<button class="btn btn-secondary" type="button" id="botao_viagem"  onclick="alterar_numero_viagem()">'
                        +'<i class="fas fa-route"></i> Nº da Viagem'
                    +'</button>' 
                    +'<button class="btn btn-secondary" type="button" id="botao_placa"  onclick="alterar_numero_placa()">'
                        +'<i class="fas fa-truck-moving"></i> Transportadora'
                    +'</button>' 
            +'<div class="dropdown">'
            +'<button class="btn btn-secondary dropdown-toggle" type="button" id="botao_editar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                +'<i class="fas fa-calendar-alt"></i> Alterar Datas'
            +'</button>'
            +'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                +'<a class="dropdown-item"  onclick="alterar_data_chegada()"><i class="fas fa-truck-loading text-sm mr-2"></i> Chegada</a>'
                +'<a class="dropdown-item"  onclick="alterar_data_porto()"><i class="fas fa-ship text-sm mr-2"></i> Chegada no Porto</a>'
                +'<a class="dropdown-item"  onclick="alterar_data_entrega()"><i class="fas fa-shipping-fast text-sm mr-2"></i> Entrega</a>'
            +'</div></div>';
        $('.isCheck').prop('checked', $(this).prop('checked'));
        $("input:checkbox[name=linhas]:checked").each(function () {
            checkboxs.push($(this).val());
        });
        if (checkboxs.length > 0) {
            if (!$('.dt-buttons.btn-group.flex-wrap').find('#botao_editar').length){
                $('.dt-buttons.btn-group.flex-wrap').append(botao);
            }
        } else {
            $('#botao_editar').remove();
            $('#botao_placa').remove();
            $('#botao_viagem').remove();
        }
    });
    
    $(document).on('click','#checkbox', function(){
        var checkboxs = [];
        var botao = '<button class="btn btn-secondary" type="button" id="botao_viagem" onclick="alterar_numero_viagem()">'
                +'<i class="fas fa-route"></i> Nº da Viagem'
            +'</button>' 
            +'<button class="btn btn-secondary" type="button" id="botao_placa"  onclick="alterar_numero_placa()">'
                +'<i class="fas fa-truck-moving"></i> Transportadora'
            +'</button>' 
            +'<div class="dropdown">'
            +'<button class="btn btn-secondary dropdown-toggle" type="button" id="botao_editar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                +'<i class="fas fa-calendar-alt"></i> Alterar Datas'
                +'</button>'
                +'<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                    +'<a class="dropdown-item"  onclick="alterar_data_chegada()"><i class="fas fa-truck-loading text-sm mr-2"></i> Chegada</a>'
                    +'<a class="dropdown-item"  onclick="alterar_data_porto()"><i class="fas fa-ship text-sm mr-2"></i> Chegada no Porto</a>'
                    +'<a class="dropdown-item"  onclick="alterar_data_entrega()"><i class="fas fa-shipping-fast text-sm mr-2"></i> Entrega</a>'
                    +'</div></div>';
        $("input:checkbox[name=linhas]:checked").each(function () {
            checkboxs.push($(this).val());
        });
        if (checkboxs.length > 0) {
            if (!$('.dt-buttons.btn-group.flex-wrap').find('#botao_editar').length){
                $('.dt-buttons.btn-group.flex-wrap').append(botao);
            }
        } else {
            $('#botao_placa').remove();
            $('#botao_viagem').remove();
            $('#botao_editar').remove();
        }
    });
                
    function alterar_data_chegada()
    {
        var ids = [];
        var route = "{{route('notas.chegada')}}";
        $("input:checkbox[name=linhas]:checked").each(function () {
            ids.push($(this).val());
        });

        $('#titulo_modal').text('Chegada');
        $('#label_modal').text('Data de Chegada');
        $('[name="ids"]').val(ids);
        $('#formulario_modal').attr('action', route);

        $('#modal_data').modal('show');        
    }

    
    function alterar_data_porto()
    {
        var ids = [];
        var route = "{{route('notas.porto')}}";
        $("input:checkbox[name=linhas]:checked").each(function () {
            ids.push($(this).val());
        });

        $('#titulo_modal').text('Chegada no Porto');
        $('#label_modal').text('Data de Chegada no Porto');
        $('[name="ids"]').val(ids);
        $('#formulario_modal').attr('action', route);

        $('#modal_data').modal('show');
        
        
    }
    
    function alterar_data_entrega()
    {
        var ids = [];
        var route = "{{route('notas.entrega')}}";
        $("input:checkbox[name=linhas]:checked").each(function () {
            ids.push($(this).val());
        });

        $('#titulo_modal').text('Entrega');
        $('#label_modal').text('Data de Entrega');
        $('[name="ids"]').val(ids);
        $('#formulario_modal').attr('action',  route);
        
        $('#modal_data').modal('show');
        
        
    }

    function alterar_numero_viagem()
    {
        var ids = [];
        $("input:checkbox[name=linhas]:checked").each(function () {
            ids.push($(this).val());
        });
        $('[name="ids_viagens"]').val(ids);

        $('#modal_viagem').modal('show');        
    }

    function alterar_numero_placa()
    {
        var ids = [];
        $("input:checkbox[name=linhas]:checked").each(function () {
            ids.push($(this).val());
        });
        $('[name="ids_placa"]').val(ids);

        $('#modal_placa').modal('show');        
    }
    
    
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