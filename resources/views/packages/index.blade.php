@extends('layouts.main')

@section('content')


    <div class="page-content">


        @if (session()->has('success'))
            <div class="alert alert-success" style="margin: auto;text-align:center">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" style="margin: auto;text-align:center">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@lang("site.Document Packages")</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('site.AllPackages')</li>
                    </ol>
                </nav>
            </div>

        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <form id="product-form" method="POST" action="{{ route('sendproducts') }}">
                        @csrf
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang("site.Package / Request ID")</th>
                                    <th>@lang("site.Requested Date")</th>
                                    <th>@lang("site.Format / Type")</th>
                                    <th>@lang("site.Date From")</th>
                                    <th>@lang("site.Date To")</th>
                                    <th>@lang("site.Status")</th>
                                    <th>@lang("site.Format / Type")</th>
                                    <th@lang("site.Package Status")></th>
                                    <th>@lang("site.DownloaD Package")</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $package['packageId'] }}</td>
                                        <td>{{ Carbon\Carbon::parse($package['submissionDate'])->format('d-m-Y') }}</td>


                                        @if ($package['type'] == 1)
                                            <td>كامل</td>
                                        @elseif($package['type'] == 2)
                                            <td>ملخص</td>
                                        @endif
                                        <td>{{ Carbon\Carbon::parse($package['queryParams']['dateFrom'])->format('d-m-Y') }}
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($package['queryParams']['dateTo'])->format('d-m-Y') }}
                                        </td>
                                        @if ($package['queryParams']['statuses'] == '')
                                            <td>جميع الحالات</td>
                                        @else
                                            <td>{{ $package['queryParams']['statuses'] }}</td>
                                        @endif
                                        <td>{{ $package['queryParams']['documentFormat'] }}</td>
                                        @if ($package['status'] == 1)
                                            <td>تحت التنفيذ</td>
                                        @elseif($package['status'] == 2)
                                            <td>مكتمل</td>
                                        @elseif($package['status'] == 3)
                                            <td>خاطئة</td>
                                        @elseif($package['status'] == 4)
                                            <td>تم مسحها</td>
                                        @endif
                                        @if ($package['status'] == 2)
                                            <td>
                                                <form action="{{ route('downloadPackage', $package['packageId']) }}"
                                                    method="get">
                                                    <button type="submit" class="btn btn-success">تحميل</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>غير متاح</td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection


@push('js')
    <script>
        $("#product-submit").on('click', function() {

            $("#product-form").submit();

        });
    </script>
    <script src="{{ asset('main/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('main/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>



@endpush
