@extends('layouts.main')

@section('content')


<div class="page-content">

    {{--  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang("site.products")</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('products.create') }}" class="btn btn-outline-success px-5 radius-30">
                    <i class="bx bx-message-square-edit mr-1"></i>@lang('site.create_product') </a>

            </div>
        </div>
    </div>  --}}

<div style="text-align: center; margin: 20px">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li style="list-style: none;font-size:25px">{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif


    @if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li style="list-style: none;font-size:25px">{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif
</div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('site.Reciever_Name')</th>
                            <th>@lang('site.Total')</th>
                            <th>@lang('site.invoice status')</th>
                            <th>@lang('site.internalid') </th>
                            <th>@lang('site.uuid') </th>
                            <th>@lang('site.doc_view')</th>
                            <th>@lang('site.doc_Download')</th>
                            <th>@lang('site.doc_cancel')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allInvoices as $index => $invoice)
                        @if($invoice['issuerId'] !==$taxId && $invoice['receiverId'] === $taxId)
                        <tr>
                            <td>{{ $invoice['issuerName'] }}</td>
                            <td>{{ $invoice['total'] }} EGP</td>
                            @if($invoice['status'] === "Valid")
                            <td>@lang('site.valid')</td>
                            @elseif ($invoice['status'] === "Invalid")
                            <td>@lang('site.invalid')</td>
                            @elseif($invoice['status'] === "Rejected")
                            <td>@lang('site.rejected')</td>
                            @else
                            <td>{{ $invoice['status'] }}</td>
                            @endif
                            <td> {{ ($invoice['uuid']) }}</td>
                            <td> {{ ($invoice['internalId']) }}</td>

                            <td><a href="https://invoicing.eta.gov.eg/print/documents/{{ $invoice['uuid']}}/share/{{ $invoice['longId'] }}" target="_blank"
                                    class="btn btn-success">@lang('site.viewinportal')</a>
                            </td>
                            <td><a href="{{ route('pdf',$invoice['uuid']) }}" class="btn btn-info"target="_blank"> @lang('site.download') </a></td>
                            <td>
                                    <form action="{{ route('RejectDocument',$invoice['uuid']) }}" method="post">

                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('هل انت متأكد من  رفض الفاتورة؟');">رفض
                                            الفاتورة</button>
                                    </form>
                            </td>

                        </tr>
                        @endif
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>



@endsection


@push('js')

<script src="{{ asset('main/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('main/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(function() {
			$('#example').DataTable();
		  } );
</script>
<script>
    $(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print'],
                sort:false
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
</script>

@endpush
