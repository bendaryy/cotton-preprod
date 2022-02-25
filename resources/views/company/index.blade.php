@extends('layouts.main')

@section('content')


			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">@lang("site.apicompany")</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('company.edit', $company->id) }}" class="btn btn-outline-success px-5 radius-30">
                                <i class="bx bx-message-square-edit mr-1"></i>@lang('site.edit') </a>

						</div>
					</div>
				</div>

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>@lang('site.name_ar') </th>
										<th>@lang('site.name_en') </th>
										<th>@lang('site.reg_num') </th>
										<th>@lang('site.email') </th>
										<th>@lang('site.logo') </th>
										<th>@lang('site.lang') </th>
										<th>@lang('site.primary_address') </th>
									</tr>
								</thead>
								<tbody>

									<tr>
										<td>{{ $company->name_ar}}</td>
										<td>{{ $company->name_en }}</td>
										<td>{{ $company->reg_number  }}</td>
										<td>{{ $company->email }}</td>
										<td><img class="user-img" src="{{ asset('images/' . $company->logo) }}"></td>
										<td>{{ $company->lang }}</td>
										<td>{{ $company->primary_address }}</td>
									</tr>

								</tbody>
								<tfoot>
									<tr>
                                        <th>@lang('site.name_ar') </th>
										<th>@lang('site.name_en') </th>
										<th>@lang('site.reg_num') </th>
										<th>@lang('site.email') </th>
										<th>@lang('site.logo') </th>
										<th>@lang('site.lang') </th>
										<th>@lang('site.primary_address') </th>
									</tr>
								</tfoot>
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
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

@endpush
