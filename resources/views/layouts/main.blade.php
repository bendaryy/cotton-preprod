<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" class="color-sidebar sidebarcolor3 color-header headercolor5">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Roboto:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    <link href="{{ asset('main/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/highcharts/css/highcharts.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('main/css/pace.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('main/plugins/notifications/css/lobibox.min.css') }}" />
    <script src="{{ asset('main/js/pace.min.js') }}"></script>
    <link href="{{ asset('main/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('main/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('main/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('main/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('main/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('main/css/semi-dark.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('main/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/header-colors.css') }}" />
    <link rel="icon" href="{{ asset('main/images/favicon-32x32.png') }}" type="image/png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (LaravelLocalization::getCurrentLocale() == 'en')
        <link href="{{ asset('main/css/style.css') }}" rel="stylesheet">

    @endif
    @stack('css')
    <title>{{ config('app.name', 'E_TAX') }}</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                 {{--  <div>
                    <img src="{{ asset('images/' . $company->logo) }}" class="logo-icon" alt="logo icon">
                </div>  --}}


                <div>
                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                    <a href="{{ url('/') }}">  <h4 class="logo-text">Fouad El-Watan</h4></a>
                    @else
                    <a href="{{ url('/') }}"><h4 class="logo-text">Fouad El-Watan</h4></a>
                    @endif

                </div>

                <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i></div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">

                <li>
                <a href="{{ url('/') }}">
                    <div class="parent-icon"><i class='bx bx-home'></i></div>
                    <div class="menu-title">@lang('site.dashboard')</div>
                </a>
                </li>

                {{-- المنتجات --}}
                {{-- <li class="menu-label">المنتجات</li> --}}
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-cart-alt"></i>
                        </div>
                        <div class="menu-title">@lang('site.products')</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('active') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.Active Products')
                            </a>
                        </li>
                        <li> <a href="{{ route('pending') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.Pending Products')
                            </a>
                        </li>
                        <li> <a href="{{ route('products.create') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.create_product')
                            </a>
                        </li>
                    </ul>
                </li>






                {{-- الوثائق --}}


                {{-- <li class="menu-label">الوثائق</li> --}}
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i>
                        </div>
                        <div class="menu-title">@lang('site.documents')</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('sentInvoices') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.sent_documents')</a>
                        </li>
                        <li> <a href="{{ route('receivedInvoices') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.received_documents')</a>
                        </li>
                        <li> <a href="{{ route('createInvoice') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.add-document')</a>
                        </li>
                    </ul>
                </li>

                {{-- حزم الوثائق --}}

                {{-- <li class="menu-label">حزم الوثائق</li> --}}
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-folder-plus"></i>
                        </div>
                        <div class="menu-title">@lang('site.Document Packages')</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('addFullPackage') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.createDocumentPackageFull')</a>
                        </li>
                        <li> <a href="{{ route('addPackageSummary') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.createDocumentPackageSummary')</a>
                        </li>
                        <li> <a href="{{ route('showAllPackages') }}">
                            <i class="bx bx-right-arrow-alt"></i>@lang('site.showAllPackages')</a>
                        </li>
                    </ul>
                </li>

                {{-- العملاء --}}

                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                        </div>
                        <div class="menu-title">@lang('site.customers')</div>
                    </a>

                    <ul>
                        <li> <a href="{{ route('customer.index') }}"><i class="bx bx-right-arrow-alt"></i>@lang('site.allcustomers')</a></li>

                        <li> <a href="{{ route('customer.create') }}"><i
                            class="bx bx-right-arrow-alt"></i>@lang('site.create-customer')</a></li>

                    </ul>
                </li>


                {{-- الإعدادات --}}
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class='fadeIn animated bx bx-cog'></i>
                        </div>
                        <div class="menu-title">@lang('site.settings')</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('setting.index') }}"><i
                                    class="bx bx-right-arrow-alt"></i>@lang('site.apisetting')</a></li>
                        {{--  <li> <a href="{{ route('company.index') }}"><i
                                    class="bx bx-right-arrow-alt"></i>@lang('site.com_setting')</a></li>  --}}
                        {{--  <li> <a href="{{ route('issure.index') }}"><i
                                    class="bx bx-right-arrow-alt"></i>@lang('site.issure_file')</a></li>  --}}

                    </ul>
                </li>
                {{-- الإشعارات --}}
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class='bx bx-bell'></i>
                        </div>
                        <div class="menu-title">@lang('site.Notifications')</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('getNotifications') }}"><i
                                    class="bx bx-right-arrow-alt"></i>@lang('site.Notifications')</a></li>

                    </ul>
                </li>
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    {{-- <div>
                        <i class=" fadeIn animated bx bx-wifi" style="font-size: 30px;color: #14ce28;"></i>
                        <i class="fadeIn animated bx bx-wifi-off" style="font-size: 30px;color: #d71919;"></i>
                    </div> --}}
                    <div class="top-menu ms-auto">
                        {{--  <ul class="navbar-nav align-items-center">

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('main/flags/' . LaravelLocalization::getCurrentLocale() . '.svg') }}"
                                        width="30">
                                    {{ LaravelLocalization::getCurrentLocaleName() }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <ul class="locales">
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li>
                                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    <img src="{{ asset('main/flags/' . $localeCode . '.svg') }}"
                                                        width="22px">
                                                    {{ $properties['native'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>


                        </ul>  --}}
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/' . Auth::user()->avatar) }}" class="user-img"
                                alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ Auth::user()->name }} </p>

                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="bx bx-user"></i><span>
                                        @lang('site.profile')</span></a>
                            </li>

                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>

                                <a class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class='bx bx-log-out-circle'></i><span> @lang('site.logout')</span>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </a>

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">

            @yield('content')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. Developed By <a href="" target=".blank">Fouad El-Watan Team</a></p>
        </footer>
    </div>
    @if (session()->has('modal'))
        jQuery.noConflict();
        <script src="{{ asset('main/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>

        <script>
            $('#exampleModal').modal({
                show: 'true'
            });
        </script>

    @endif

    <script src="{{ asset('main/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.min.js') }}"></script>
    <script src="{{ asset('main/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('main/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    {{-- <script src="{{ asset('main/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script> --}}
    <script src="{{ asset('main/plugins/notifications/js/notifications.min.js') }}"></script>

    @stack('js')
    {{-- <script src="{{ asset('main/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('main/js/index2.js')}}"></script> --}}

    <script src="{{ asset('main/js/app.js') }}"></script>
    {{-- <script>
        new PerfectScrollbar('.customers-list');
		new PerfectScrollbar('.store-metrics');
		new PerfectScrollbar('.product-list');
    </script> --}}


    @if ($errors->any())

        @foreach ($errors->all() as $error)

            <script>
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-error',
                    msg: '{{ $error }}'
                });
            </script>


        @endforeach

    @endif


    @if (session()->has('message'))

        <script>
            Lobibox.notify('info', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'bx bx-info-circle',
                msg: "{{ session()->get('message') }}"
            });
        </script>


    @endif



    <script src="{{ asset('main/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script src="{{ asset('main/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('main/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('main/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="{{ asset('main/plugins/bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('main/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}">
    </script>

    <script>
        $('.datepicker').pickadate({
                selectMonths: true,
                selectYears: true
            }),
            $('.timepicker').pickatime()
    </script>
    <script>
        $(function() {
            $('#date-time').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm'
            });
            $('#date').bootstrapMaterialDatePicker({
                time: false
            });
            $('#time').bootstrapMaterialDatePicker({
                date: false,
                format: 'HH:mm'
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {

            var form = $(this).closest("form");

            var name = $(this).data("name");

            event.preventDefault();

            swal({

                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,

                })

                .then((willDelete) => {

                    if (willDelete) {

                        form.submit();

                    }

                });

        });
    </script>
</body>



</html>
