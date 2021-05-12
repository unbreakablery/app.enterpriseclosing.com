<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-black">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm top-layer border-bottom">
            <div class="container no-max-width">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="images/avatar.png" alt="Settings" style="height: 25px; width: 25px;">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('settings') }}">
                                        {{ __('Settings') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.noConflict();
            // $('.datatable').DataTable( {
            //     initComplete: function () {
            //         this.api().columns().every( function () {
            //             var column = this;
            //             var select = $('<select style="width: 100%"><option value=""></option></select>')
            //                 .appendTo( $(column.header()).empty() )
            //                 .on( 'change', function () {
            //                     var val = $.fn.dataTable.util.escapeRegex(
            //                         $(this).val()
            //                     );
        
            //                     column
            //                         .search( val ? '^'+val+'$' : '', true, false )
            //                         .draw();
            //                 } );
        
            //             column.data().unique().sort().each( function ( d, j ) {
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //             } );
            //         } );
            //     }
            // } );


            // Setup - add a text input to each footer cell
            $('#table-1 thead tr').clone(true).appendTo( '#table-1 thead' );
            $('#table-1 thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                var class_name = (i == 1 || i == 2 || i == 3) ? 'date' : '';

                $(this).html( '<input class="' + class_name + '" type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table1.column(i).search() !== this.value ) {
                        table1
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $('#table-2 thead tr').clone(true).appendTo( '#table-2 thead' );
            $('#table-2 thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                var class_name = (i == 2) ? 'date' : '';

                $(this).html( '<input class="' + class_name + '" type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table2.column(i).search() !== this.value ) {
                        table2
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        
            var table1 = $('#table-1').DataTable( {
                orderCellsTop: true,
                fixedHeader: true,
                info: false,
                paging: false
            } );
            var table2 = $('#table-2').DataTable( {
                orderCellsTop: true,
                fixedHeader: true,
                info: false,
                paging: false
            } );

            $('.date').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: "linked",
                todayHighlight: true,
                clearBtn: true
            });
        } );
    </script>
</body>
</html>
