
@extends('layouts.main')

@section('content')


			<div class="page-content">

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">@lang("site.ducoments")</li>
							</ol>
						</nav>
					</div>

					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('document.create') }}" class="btn btn-outline-success px-5 radius-30">
                                <i class="bx bx-message-square-edit mr-1"></i>@lang('site.add-document') </a>

						</div>
					</div>
				</div>

				<hr/>

                <div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							<div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div>
 						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="table-light">
									<tr>
										<th>Order#</th>
										<th>Company Name</th>
										<th>Status</th>
										<th>Total</th>
										<th>Date</th>
										<th>View Details</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>

                                    @foreach ($orders as $order)

									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div>
													<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
												</div>
												<div class="ms-2">
													<h6 class="mb-0 font-14">#OS-000354</h6>
												</div>
											</div>
										</td>
										<td>Gaspur Antunes</td>
										<td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>FulFilled</div></td>
										<td>$485.20</td>
										<td>June 10, 2020</td>
										<td><a  href="{{ route('submitorder', $order->id) }}" class="btn btn-primary btn-sm radius-30 px-4">Submit Order</a></td>
										<td>
											<div class="d-flex order-actions">
												<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>
												<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>

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
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

@endpush
