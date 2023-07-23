<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('public/admin/css/style.css') }}?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">

    @include('include.css')

    <link href="{{ asset('public/css/custom.css') }}?v=<?php echo time(); ?>" rel="stylesheet" />

    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        @include('pages.employer.header')
        @include('pages.employer.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        @include('pages.employer.footer')
    </div>

    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/admin.js') }}"></script>
    
    @include('include.js')

    <script type="text/javascript">
        $(function() {
          let copyButtonTrans = 'Copy'
          let csvButtonTrans = 'Csv'
          let excelButtonTrans = 'Excel'
          let pdfButtonTrans = 'Pdf'
          let printButtonTrans = 'Print'
          let colvisButtonTrans = 'Colvis'

          let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
          };

          $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
          $.extend(true, $.fn.dataTable.defaults, {
            language: {
              url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
              style:    'multi+shift',
              selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [              
              {
                extend: 'csv',
                className: 'btn-default',
                text: csvButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'excel',
                className: 'btn-default',
                text: excelButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              }
            ]
          });

          $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>

    @stack('js')
</body>
</html>
