@extends('layouts.main')

@section('content')


			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">@lang("site.issure_file")</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('issure.create') }}" class="btn btn-outline-success px-5 radius-30">
                                <i class="bx bx-message-square-plus mr-1"></i>@lang('site.addissure') </a>

						</div>
					</div>
				</div>

				<hr/>


				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>

                                    {{--    --}}
									<tr>
										<th>@lang('site.name') </th>
										<th>@lang('site.branchID') </th>
										<th>@lang('site.country') </th>
										<th>@lang('site.governate') </th>
										<th>@lang('site.regionCity') </th>
										<th>@lang('site.street') </th>
										<th>@lang('site.buildingNumber') </th>
										<th>@lang('site.postalCode') </th>
										<th>@lang('site.floor') </th>
										<th>@lang('site.room') </th>
										<th>@lang('site.landmark') </th>
										<th>@lang('site.reg_num') </th>
										<th>@lang('site.type') </th>
										<th>@lang('site.additionalInformation') </th>
										<th>@lang('site.control') </th>

									</tr>
								</thead>
								<tbody>

                                    @foreach ($issures as $issure)


									<tr>
										<td>{{ $issure->company_name}}</td>
										{{-- <td>{{ $issure->branchID }}</td> --}}
										<td>0</td>
										<td>EG</td>
										<td>{{ $issure->governate }}</td>
										<td>{{ $issure->regionCity }}</td>
										<td>{{ $issure->street }}</td>
										<td>{{ $issure->buildingNumber }}</td>
										{{-- <td>{{ $issure->postalCode }}</td> --}}
										<td>{{ $issure->floor }}</td>
										<td>{{ $issure->room }}</td>
										<td>{{ $issure->landmark }}</td>
										<td>{{ $issure->regid }}</td>
										<td> @lang('site.' . $issure->type) </td>
										<td>{{ $issure->additionalInformation }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                            <form style="display: contents;" method="post" action="{{ route('issure.destroy', $issure->id) }}">
                                                @csrf
                                                @method('delete')
                                           <button type="sumbit" class="btn btn-outline-danger"><i class="bx bxs-trash me-0"></i></button>
                                            </form>

                                            <a href="{{ route('issure.edit', $issure->id) }}" class="btn btn-outline-primary"><i class="bx bxs-edit me-0"></i></a>


                                            </div>
                                        </td>
									</tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
        								<th>@lang('site.name') </th>
										<th>@lang('site.branchID') </th>
										<th>@lang('site.country') </th>
										<th>@lang('site.governate') </th>
										<th>@lang('site.regionCity') </th>
										<th>@lang('site.street') </th>
										<th>@lang('site.buildingNumber') </th>
										<th>@lang('site.postalCode') </th>
										<th>@lang('site.floor') </th>
										<th>@lang('site.room') </th>
										<th>@lang('site.landmark') </th>
										<th>@lang('site.reg_num') </th>
										<th>@lang('site.type') </th>
										<th>@lang('site.additionalInformation') </th>
										<th>@lang('site.control') </th>
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
