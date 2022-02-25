@extends('layouts.main')

@section('content')


<div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.Active Products')</li>
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
                              <th># </th>
                                <th>@lang('site.egs-code') </th>
                                <th>@lang('site.gpc_code') </th>
                                <th>@lang('site.status') </th>
                                <th>@lang('site.name_ar') </th>
                                <th>@lang('site.desc_ar') </th>
                                <th>@lang('site.name_en') </th>
                                <th>@lang('site.desc_en') </th>
                                <th>@lang('site.active_from') </th>
                                <th>@lang('site.active_to') </th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($products as $index => $product)

                            <tr>
                                <td>{{ $index + 1}}</td>
                                <td>{{ $product['itemCode']}}</td>
                                <td>{{ $product['parentItemCode']}}</td>
                                @if($product['status'] === "Approved")
                                <td>@lang('site.Approved')</td>
                                @endif
                                <td>{{ $product['codeNameSecondaryLang']}}</td>
                                <td>{{ $product['descriptionSecondaryLang']}}</td>
                                <td>{{ $product['codeNamePrimaryLang']}}</td>
                                <td>{{ $product['descriptionPrimaryLang']}}</td>
                                <td>{{ \Carbon\Carbon::parse($product['activeFrom'])->format('d-m-Y')}}</td>
                                @if($product['activeTo'] == NULL)
                                <td></td>
                                @else
                                <td>{{ \Carbon\Carbon::parse($product['activeTo'])->format('d-m-Y')}}</td>
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
    $("#product-submit").on('click', function () {

        $("#product-form").submit();

    });
</script>
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
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
</script>



@endpush
