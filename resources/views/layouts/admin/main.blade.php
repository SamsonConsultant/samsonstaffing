<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pamsha') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> --}}

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">

    @include('include.css')

    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet" />

    @stack('css')

</head>
<body id="page-top">
    @yield('content')

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    {{-- <script src="{{ asset('public/js/app.js') }}" defer></script> --}}

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
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
