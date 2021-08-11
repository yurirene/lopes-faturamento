@extends('restrito.template')

@section('title', 'RH Fênix::Candidato')

@section('content_header')
    <h1>Candidato</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                <h3 class="card-title">Informações do Candidato</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col text-left">
                        <p class="texto-grande">
                            <b>Nome:</b> {{$candidato->nome}}
                        </p>

                        <p class="texto-grande">
                            <b>Data Nascimento:</b> {{$candidato->data_nascimento->format('d/m/y')}}
                        </p>

                        <p class="texto-grande">
                            <b>E-mail:</b> {{$candidato->email}}
                        </p>

                        <p class="texto-grande">
                            <b>Telefone:</b> {{$candidato->telefone}}
                        </p>

                        <p class="texto-grande">
                            <b>Áreas de Atuação:</b> {{implode(', ' ,$candidato->areas->pluck('nome')->toArray())}}
                        </p>

                        <p class="texto-grande">
                            <b>Tags:</b> {{implode(', ', $candidato->tags->pluck('nome')->toArray())}}
                        </p>

                        <p class="texto-grande">
                            <b>Observação:</b> {{$candidato->observacao}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card card-outline card-primary  h-100">
            <div class="card-header">
                <h3 class="card-title">Currículo</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
               <iframe src="https://google.com" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')


@endpush
