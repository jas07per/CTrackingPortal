<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('DICT MC3', 'DICT MC3') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    
    <!-- Latest compiled and minified JavaScript -->
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}
<script type="application/javascript" src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>


<script>
 
    var baseUrl = "{{url('')}}";
    $(document).ready(function(){
        $('#dv_tbl').DataTable();
            // $('#employee_tbl').DataTable({
            //     "order": [[ 5, "desc" ]]
            // });
            $(function () {
                    $('select').selectpicker();
            });
           
            // for adding document
            $('#btn-add-doc').on('click', function() {
                $('#modal_content_add').show();
                // $('#modal_add_notification').hide();
                // $('#modal_notication_add_body').html('');
                $('#modal_add_doc').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            })

            // end adding document
            // for adding dv
            $('#btn_add_dv').on('click', function() {
                $('#modal_add_dv').show();
                // $('#modal_add_notification').hide();
                // $('#modal_notication_add_body').html('');
                $('#modal_add').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            })
            // end adding dv
            $('#btn_import').on('click', function() {
                $('#modal_content_import').show();
                $('#modal_content_notification').hide();
                $('#modal_notication_body').html('');
                $('#modal_import').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            })

            $('#file_upload').on('change', function() {
                    var ext = this.value.match(/\.([^\.]+)$/)[1];
                    switch (ext) {
                        case 'xls':
                        case 'xlsx':
                        case 'csv':
                            break;
                        default:
                            alert('The file you selected is not allowed.');
                            this.value = '';
                    }
                })

                $('#btn_upload').on('click', function() {
                            needs_refresh = 0;
                            if ($('#file_upload').get(0).files.length === 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No file selected.',
                                    text: 'Please select the file to upload!',
                                })
                                return false;
                            } 
                            //else {
                            //    $('#btn_upload')
                            //}

                            var formData = new FormData(document.getElementById("form_upload"));
                           
                            // formData.append('training_id', training_id);
                            //formData = new FormData($('form[name="form_upload"]'));
                            $.ajax({
                                url: baseUrl + "/upload_dv", //Server script to process data
                                type: 'POST',
                                // Form data
                                data: formData,
                                //beforeSend: beforeSendHandler, // its a function which you have to define
                                success: function(response) {
                                    $('#modal_content_import').hide();
                                    $('#modal_content_notification').show();
                                    $('#modal_notication_body').html(response);
                                    
                                },
                                error: function(data) {
                                   alert('ERROR at server. Please check your excel file, It should not contain any empty cell. Only the Extension name is allowed empty.');
                                   // alert(data);
                                },
                                 //alert('ERROR at server. Please check your excel file, It should not contain any empty cell. Only the Extension name is allowed empty.');
                                //Options to tell jQuery not to process data or worry about content-type.
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        })
    });

</script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm" style="background-color: #e3f2fd; !important">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Email Us!') }}</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        @if (Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userManagement') }}">{{ __('User Management') }}</a>
                                </li>
                        @endif
                           {{-- for finance setup --}}
                           @if (Auth::user()->hasRole('finance'))
                           <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ 'Setup' }}
                            </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               
                                <a href="{{route('dv')}}" class="dropdown-item"  >
                                    {{'Disbursement Voucher'}}
                                </a>
                                <a  href="{{route('docs')}}" class="dropdown-item"   >
                                    {{'Required Documents'}}
                                </a>
                                
                                </div>
                            </li>
                            @endif
                           {{-- end for finance setup --}}
                          
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
</body>
</html>
