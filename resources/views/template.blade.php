@extends('adminlte::page')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

</head>
@stop



@section('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
{{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('{{$error}}')
        @endforeach
    @endif
    @if (session('mensagem'))
        toastr.success('{{session("mensagem")}}');
    @endif
    $('.isSelect2').select2();

    function deleteRegister(registro) {
        const url = registro.getAttribute("data-rota");
        
        swal({
            title: 'Tem Certeza?',
            text: "Esse registro será excluído.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
            }
        });
    }

    function deleteArchive(path) {
        const url = path.getAttribute("data-rota");
        swal({
            title: 'Deseja excluir esse arquivo?',
            text: 'O arquivo selecionado será permanentemente excluído.',
            icon: "warning",
            buttons: true,
            dangerMode: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
            }
        });
    }
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

@stop
