<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title or "IndexBase Hub"}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
        <link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/remodal.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/remodal-default-theme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/rangeslider.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css"> --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="{{ mix('css/custom.css') }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">IndexBase = {};</script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="app" class="wrapper">
            @include('partials.adminlte.header')
            @include('partials.adminlte.left-sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div  class="content-wrapper">
                    @yield('content')
                </div>
                <!-- /.content-wrapper -->
            @include('partials.adminlte.footer')
            <!--modals-->
            @stack('modals')
            <!--end modals-->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 and jQuery UI 1.11.4 -->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/jqueryui.js') }}"></script>
        <script src="{{ asset('js/remodal.js') }}"></script>
        <script src="{{ asset('js/rangeslider.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : '{{csrf_token()}}',
                },
                data: {
                    _token: '{{csrf_token()}}',
                },
                error: function(xhr, status, error){
                    console.log(xhr,status,error);
                }
            });
        </script>
        <script type="text/javascript">
            IndexBase.data = {};
            IndexBase.csrf = '{{csrf_token()}}';
            @stack('BaseData')
        </script>
        <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.js"></script>
        @yield('mainScript')
    </body>
</html>