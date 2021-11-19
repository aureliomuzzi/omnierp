<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css"></link>
    <link rel="stylesheet" type="text/css" href="/css/icheck-bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-switch.min.css"></link>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-toggle.min.css"></link>
    <link rel="stylesheet" type="text/css" href="/css/buttons.dataTables.min.css"></link>

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script src="/js/chart.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/bootstrap-switch.min.js"></script>
    <script src="/js/bootstrap-toggle.min.js"></script>
    <script src="/js/dataTables.buttons.min.js"></script>
    <script src="/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    <script>
        function confirmarExclusao(event) {
            event.preventDefault();
            swal({
                title: "Voce tem certeza que deseja excluir esse registro?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                cancel: "Cancelar",
                catch: {
                    text: "Excluir",
                    value: true,
                },
                }
            })
            .then((willDelete) => {
                if (willDelete) {
                event.target.submit();
                } else {
                return false;
                }
            });
        }
        $(function () {
            $('#datatable').DataTable({
                language: {
                    url: "/js/translate_pt-br.json"
                },
                paging: false
            });
            $('[data-toggle="tooltip"]').tooltip();

            $('[data-toggle="switch"]').bootstrapSwitch();

            $('#status').bootstrapToggle({
                on: 'Ativo',
                off: 'Inativo'
            });
        });
        // API ViaCEP -- Inicio --
            var inputsCEP = $('#logradouro, #bairro, #localidade, #uf', '#cep');
            var inputsRUA = $('#cep, #bairro');
            var validacep = /^[0-9]{8}$/;
            function limpar(alerta) {
                if (alerta !== undefined) {
                    swal({
                        title: alerta,
                        icon: "warning",
                        buttons:{
                            cancel: "Fechar"
                        }
                    });
                    inputsCEP.val('');
                }
            }
            function get(url) {
                $.get(url, function(data) {
                    if (!("erro" in data)) {
                        if (Object.prototype.toString.call(data) === '[object Array]') {
                            var data = data[0];
                        }
                        $.each(data, function(nome, info) {
                            $('#' + nome).val(nome === 'cep' ? info.replace(/\D/g, '') : info).attr('info', nome === 'cep' ? info.replace(/\D/g, '') : info);
                        });
                    } else {
                        limpar("CEP não encontrado.");
                    }
                });
            }
            // Digitando CEP
            $('#cep').on('blur', function(e) {
                var cep = $('#cep').val().replace(/\D/g, '');
                if (cep !== "" && validacep.test(cep)) {
                    inputsCEP.val('Localizando...');
                    get('https://viacep.com.br/ws/' + cep + '/json/');
                } else {
                    limpar(cep == "" ? undefined : "Formato de CEP inválido.");
                }
            });
        // API ViaCEP -- Fim --
        $('.isFone').mask('(00) 00000-0000');
        $('.isCPF').mask('000.000.000-00');
        $('.isCNPJ').mask('00.000.000/0000-00');
        window.onload = () => {
            $("input[name='tipo']").change(function(){
                if ($(this).val() == 'PF') {
                    $("#cpf_cnpj").val('');
                    $("#fantasia").val('');
                    $("#fantasia").prop('disabled', true);

                    $("#clMatriz").prop('disabled',true);
                    $("#clMatriz").prop('checked',false);

                    $("#clFilial").prop('disabled',true);
                    $("#clFilial").prop('checked',false);

                    $("#clMei").prop('disabled',true);
                    $("#clMei").prop('checked',false);

                    $("#clOng").prop('disabled',true);
                    $("#clOng").prop('checked',false);

                    $("#cpf_cnpj").mask('000.000.000-00');
                }
            });

            $("input[name='tipo']").change(function(){
                if ($(this).val() == 'PJ') {
                    $("#cpf_cnpj").val('');
                    $("#fantasia").prop('disabled', false);
                    $("#clMatriz").prop('disabled',false);
                    $("#clFilial").prop('disabled',false);
                    $("#clMei").prop('disabled',false);
                    $("#clOng").prop('disabled',false);
                    $("#cpf_cnpj").mask('00.000.000/0000-00');
                }
            });
        }
    </script>
    @yield('javascript')


</body>

</html>
