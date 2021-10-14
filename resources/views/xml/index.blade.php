@extends('template')

@section('title', 'Importar XML')

@section('content_header')
    <h1>Importar XML</h1>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Importar NF-e</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('xml.importar-xml'), 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('industria', 'Industria') !!}
                    {!! Form::select('industria', $industrias, null, ['class' => 'form-control', 'required', 'id' => 'industria_select']) !!}
                </div>
                <div class="form-group" id="fator_multiplicacao" style="display: none;">
                    <label>Frete</label>
                    <input type="text" class="form-control isDecimal" name="frete" id="frete" >
                </div>
                <label>Arquivo</label> <span class="text-danger">*</span>
                <div class="custom-file mb-3">
                    <input id="arquivo" name="arquivos[]" type="file" class="file"  data-show-upload="true" data-show-caption="true" multiple required>
                    <label class="custom-file-label" for="arquivo" >Selecione o Arquivo</label>
                </div>

                <div class="form-group">
                {!! Form::button("<i class='fas fa-save'></i> Salvar", ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('home') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
     $('.isDecimal').mask('0.00');

    $('#industria_select').on('change', function() {
        if ($(this).val() == 3) {
            $('#fator_multiplicacao').show();
            $( "#frete" ).prop( "disabled", false );
            $( "#frete" ).prop( "required", true );
        } else {
            $('#fator_multiplicacao').hide();
            $( "#frete" ).prop( "required", false );
            $( "#frete" ).prop( "disabled", true );
        }
    })

</script>

@endpush