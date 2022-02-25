@extends('layouts.main')


@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col">
                <a href="{{ route('getNotifications') }}">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.Notifications')</p>
                                <h4 class="font-weight-bold">

                                </h4>
                            </div>
                            <div class="widgets-icons bg-gradient-cosmic text-white"><i class='bx bx-bell'></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col">
                <a href="{{ route('customer.index') }}">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.customers')</p>
                                <h4 class="font-weight-bold">

                                </h4>
                            </div>
                            <div class="widgets-icons bg-gradient-burning text-white"><i class='bx bx-group'></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col">
                <a href="{{ route('active') }}">
                    <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.Active Products')</p>
                                <h4 class="font-weight-bold">
                                </h4>
                            </div>
                            <div class="widgets-icons bg-gradient-lush text-white"><i class='bx bx-time'></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col">
                <a href="{{ route('showAllPackages') }}">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.Document Packages')</p>
                            </h4>
                        </div>
                            <div class="widgets-icons bg-gradient-kyoto text-white"><i class='bx bxs-cube'></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col">
                <a href="{{ route('sentInvoices') }}">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.sent_documents')</p>
                                <h4 class="font-weight-bold">
                                </h4>
                            </div>
                            <div class="widgets-icons bg-gradient-blues text-white"><i class='bx bx-line-chart'></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col">
                <a href="{{ route('receivedInvoices') }}">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="mb-0">@lang('site.received_documents')</p>
                                <h4 class="font-weight-bold">
                                </h4>
                            </div>
                            <div class="widgets-icons bg-gradient-moonlit text-white"><i class='bx bx-bar-chart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div></a>
        </div>
        <!--end row-->
        <div class="row">
            @endsection

@push('js')
    <script src="{{ asset('main/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('main/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('main/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/highcharts.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/highcharts-more.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/variable-pie.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/solid-gauge.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/highcharts-3d.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/cylinder.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/funnel3d.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/exporting.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/export-data.js')}}"></script>
    <script src="{{ asset('main/plugins/highcharts/js/accessibility.js')}}"></script>
    <script src="{{ asset('main/js/index4.js')}}"></script>
    <script src="{{ asset('main/js/app.js')}}"></script>
@endpush
