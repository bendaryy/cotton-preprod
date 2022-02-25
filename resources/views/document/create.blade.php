@extends('layouts.main')


@section('content')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang('site.dashboard')</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.add-document')</li>
                </ol>
            </nav>
        </div>

    </div>



  <div class="card">
    <form method="POST" action="{{ route('document.store') }}">
        @csrf

      <div class="card-body p-4">

          <hr/>
           <div class="form-body mt-4">
            <div class="row">
               <div class="col-lg-12">
               <div class="border border-3 p-4 rounded">

                        <label class="form-label">@lang('site.product')</label>

                        <select class="form-control" id="choose-product">

                            @foreach ($products as $product)
                            @if (LaravelLocalization::getCurrentLocale() == 'en')
                            <option value="{{ $product->id }}"> {{ $product->name_en }}</option>
                            @else
                            <option value="{{ $product->id }}"> {{ $product->name_ar }}</option>
                            @endif
                            @endforeach
                        </select>

                  </div>

                  <div class="card">

					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>@lang('site.product') </th>
										<th>@lang('site.unit_price') </th>
										<th>@lang('site.quantity') </th>
										<th>@lang('site.desc') </th>
										<th>@lang('site.add-tax') </th>
										<th>@lang('site.discount') </th>
										<th>@lang('site.total') </th>
										<th>@lang('site.control') </th>
									</tr>
								</thead>
								<tbody id="table-body"></tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
				</div>

            </div>

                <hr/>




          <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                    <h5> @lang('site.general info') </h5>

                  <div class="row g-3">
                    <div class="col-12">
                        <label for="inputVendor" class="form-label">@lang('site.customer')

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">@lang('site.add-new')</button>
                        </label>
                        <select class="form-select" id="inputVendor" name="customer_id">
                            <option selected disabled>@lang('site.choose-customer')</option>
                            @foreach ($customers as $customer)

                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                            @endforeach

                          </select>
                      </div>

                    <div class="col-12">
                        <label for="inputProductType" class="form-label">@lang('site.Type of Document')</label>
                        <select class="form-select" id="inputProductType">
                            <option></option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                      </div>
                      <div class="col-md-12">
                        <label for="inputCostPerPrice" class="form-label">@lang('site.Shipping Cost')</label>
                        <input type="number" name="shipping" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                      </div>
                      <div class="col-md-12">
                        <label for="inputStarPoints" class="form-label">@lang('site.Order Discount')</label>
                        <input type="password" class="form-control" id="inputStarPoints" placeholder="00.00">
                      </div>



                      <div class="col-12">
                          <div class="d-grid">
                             <button type="submit" class="btn btn-primary">Save Product</button>
                          </div>
                      </div>
                  </div>
              </div>
              </div>

              <div class="col-md-4">
                <div class="border border-3 p-4 rounded">
                <h3 class="text-center text-primary" style="margin-bottom: 15px"> @lang('site.payment') </h3>

                    <table class="table">
                        <tr>
                            <td> <h5> @lang('site.tax_total') </h5></td>
                            <td> <h5 id="tax-total"> 0.00 </h5></td>
                            <input type="hidden" name="tax-total" class="tax-total">
                            <td> <span class="text-primary"> @lang('site.l.e')</span></td>
                        </tr>
                        <tr>
                            <td> <h5> @lang('site.discount_total')</h5></td>
                            <td> <h5 id="discount-total">0.00</h5></td>
                            <input type="hidden" name="discount-total" class="discount-total">
                            <td><span class="text-primary"> @lang('site.l.e')</span></td>
                        </tr>
                        <tr>
                            <td> <h5>@lang('site.total_qty')</h5>  <input type="hidden" name="total_quantity" /></td>
                            <td> <h5 id="total-quantity">0</h5></td>
                            <input type="hidden" name="total-quantity" class="total-quantity">
                            <td> <span class="text-primary"> @lang('site.product')</span></td>
                        </tr>
                        <tr>
                            <td> <h5>@lang('site.total')</h5> <input type="hidden" name="total_price" /></td>
                            <td> <h5 id="order-total">0.00</h5></td>
                            <td> <span class="text-primary"> @lang('site.l.e')</span></td>
                        </tr>
                    </table>


                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              @lang('site.bank')
                              </button>
                            </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="inputPrice" class="form-label">@lang('site.Bank Name')</label>
                                                    <input type="text" name="bank_name" class="form-control" id="inputPrice" placeholder="@lang('site.Bank Name')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputCompareatprice" class="form-label">@lang('site.Bank Account No')</label>
                                                    <input type="text" name="bank_accountno" class="form-control" id="inputCompareatprice" placeholder="@lang('site.Bank Account No')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputCostPerPrice" class="form-label">@lang('site.Swift Code')</label>
                                                    <input type="text" name="swift_code" class="form-control" id="inputCostPerPrice" placeholder="@lang('site.Swift Code')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputStarPoints" class="form-label">@lang('site.Bank Account IBAN')</label>
                                                    <input type="text" name="bank_iban" class="form-control" id="inputStarPoints" placeholder="@lang('site.Bank Account IBAN')">
                                                  </div>

                                                  <div class="col-12">
                                                    <label for="inputProductType" class="form-label">@lang('site.Bank Address')</label>
                                                    <textarea class="form-control" name="bank_address" id="inputProductType"  placeholder="@lang('site.Bank Address')"></textarea>
                                                  </div>
                                                  <div class="col-12">
                                                    <label for="inputVendor" class="form-label">@lang('site.Payment Terms')</label>
                                                    <textarea class="form-control" name="payment_terms"  placeholder="@lang('site.Payment Terms')" id="inputVendor"></textarea>
                                                  </div>



                                              </div>
                                            </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                              <button class="accordion-button collapsed btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                               @lang('site.order-details')
                              </button>
                            </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="inputPrice" class="form-label">@lang('site.Purchase Order Reference')</label>
                                                    <input type="text" name="order_purchase_ref" class="form-control" id="inputPrice" placeholder="@lang('site.Purchase Order Reference')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputCompareatprice" class="form-label">@lang('site.Purchase Order Description')</label>
                                                    <input type="text" name="order_desc" class="form-control" id="inputCompareatprice" placeholder="@lang('site.Purchase Order Description')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputCostPerPrice" class="form-label">@lang('site.Sales Order Reference')</label>
                                                    <input type="text" name="orderder_reference" class="form-control" id="inputCostPerPrice" placeholder="@lang('site.Sales Order Reference')">
                                                  </div>
                                                  <div class="col-md-12">
                                                    <label for="inputStarPoints" class="form-label">@lang('site.Sales Order Description')</label>
                                                    <input type="text" name="order_sales_desc" class="form-control" id="inputStarPoints" placeholder="@lang('site.Sales Order Description')">
                                                  </div>

                                                  <div class="col-12">
                                                    <label for="inputProductType" class="form-label">@lang('site.Proforma Invoice Number')</label>
                                                    <textarea class="form-control" name="proforma" id="inputProductType"  placeholder="@lang('site.Proforma Invoice Number')"></textarea>
                                                  </div>

                                              </div>
                                            </div>
                                    </div>
                                </div>
                            </div>


                  </div>

              </div>
              {{--  End Of Payment   --}}

              <div class="col-md-4">
                <div class="border border-3 p-4 rounded">
                <h5> @lang('site.Delivery Information') </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="inputPrice" class="form-label">@lang('site.Approach')</label>
                        <input type="text" name="approach" class="form-control" id="inputPrice" placeholder="@lang('site.Approach')">
                      </div>
                      <div class="col-md-6">
                        <label for="inputCompareatprice" class="form-label">@lang('site.Packaging')</label>
                        <input type="text" name="packaging" class="form-control" id="inputCompareatprice" placeholder="@lang('site.Packaging')">
                      </div>
                      <div class="col-md-12">
                        <label for="inputCostPerPrice" class="form-label">@lang('site.Validity Date')</label>
                        <input type="date" name="validity" class="form-control" id="inputCostPerPrice" placeholder="@lang('site.Validity Date')">
                      </div>
                      <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">@lang('site.Export Port')</label>
                        <input type="text" name="export_port" class="form-control" id="inputStarPoints" placeholder="@lang('site.Export Port')">
                      </div>

                      <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">@lang('site.Country of Origin')</label>
                        <input type="text" name="country_origin" class="form-control" id="inputStarPoints" placeholder="@lang('site.Country of Origin')">
                      </div>

                      <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">@lang('site.Gross Weight (kg)')</label>
                        <input type="text" name="cross_weight" class="form-control" id="inputStarPoints" placeholder="@lang('site.Gross Weight (kg)')">
                      </div>

                      <div class="col-md-6">
                        <label for="inputStarPoints" class="form-label">@lang('site.Net Weight (kg)')</label>
                        <input type="text" name="net_weight" class="form-control" id="inputStarPoints" placeholder="@lang('site.Net Weight (kg)')">
                      </div>

                      <div class="col-md-12">
                        <label for="inputStarPoints" class="form-label">@lang('site.Delivery Terms')</label>
                        <input type="text" name="delivery_terms" class="form-control" id="inputStarPoints" placeholder="@lang('site.Delivery Terms')">
                      </div>

                  </div>

              </div>
              </div>
           </div>
        </div>
      </div>
  </div>

    </form>

</div>




    @include('inc.customermodal')
    @include('inc.taxmodal')


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

	<script>

        $("#choose-product").on('change', function () {

            var product = $(this).val();

            $.ajax({

                type: 'POST',
                url: '{{ route("getproduct")}}',

                data: {
                    "_token": "{{ csrf_token() }}",
                    "product": product,
                  },

                success: function(data) {


              //      console.log(data);

                    if (!$.trim(data)){



                    }
                    else{
                        var rownumber = $('#table-body tr:last').index();
                        var index = rownumber + 1;

                        var newRow = $("<tr data-id='" + index +"'>");
                            var cols = '';
                            temp_unit_name =  'test';
                            cols += '<td class="col-sm-4 product-title"><strong>' + data['name_ar'] + '</strong><button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"> <i class="dripicons-document-edit"></i></button></td>';
                            cols += '<td class="col-sm-2 product-price">' + data['price'] + '</td>';
                            cols += '<td class="col-sm-3"><input type="number" name="qty[]" class="form-control qty numkey input-number" min="1" value="1" step="any" required></td>';
                            cols += '<td class="col-sm-2 product-desc"><textarea></textarea></td>';
                            cols += '<td class="col-sm-2 sub-total1"><a class="add-tax-btn btn btn-info">@lang("site.add-tax")</a></td>';
                            cols += '<td class="col-sm-2 discount"><input type="number" class="discount-val" min="0" name="product_discount[]" value="0"/></td>';
                            cols += '<td class="col-sm-2 sub-total">' + data['price'] +
                                '<input type="hidden" class="product_price" name="product_price[]" value="'+ data['price'] + '"/></td>';
                            cols += '<td class="col-sm-1"><button type="button" class="ibtnDel btn btn-danger btn-sm">X</button></td>';
                            cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data['id'] + '"/>';
                            cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                            cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value=""/>';
                            cols += '<input type="number" class="tax-value" name="tax[]" />';
                            cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                            newRow.append(cols);

                        $("#table-body").append(newRow);
                    }



                },

                error : function(err) {

                    console.log(err.responseText);
                },
            });

            calculateTotal();
            calculateGrandTotal();
        });



        //Delete product
$("#table-body").on("click", ".ibtnDel", function(event) {

    rowindex = $(this).closest('tr').index();

    $(this).closest("tr").remove();

   calculateTotal();
});

// Change Quantity

$("#table-body").on("change", ".qty", function(event) {

    calculateTotal();

   var index =  $(this).parent().parent().data('id');

    calculateRowProductData(index);

});

// Change Discount

$("#table-body").on("change", ".discount-val", function(event) {

   var index =  $(this).parent().parent().data('id');

    calculateRowProductData(index);

    calculateTotal();

});


// Change Tax

$("#table-body").on("change", ".tax-val", function(event) {

   var index =  $(this).parent().parent().data('id');

    calculateRowProductData(index);

    calculateTotal();

});

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;

    $("#table-body .qty").each(function(index) {

        if ($(this).val() == '') {
            total_qty += 0;

        } else {
            total_qty += parseFloat($(this).val());
        }
    });



  //  $('input[name="total_qty"]').val(total_qty);

    $('input[name="total_quantity"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;

    $("#table-body .discount-value").each(function() {
        total_discount += parseFloat($(this).val());
    });

    $('input[name="total_discount"]').val(total_discount.toFixed(2));

    //Sum of tax
    var total_tax = 0;
    $(".tax-value").each(function() {
        total_tax += parseFloat($(this).val());
    });

    $('input[name="total_tax"]').val(total_tax.toFixed(2));

    //Sum of subtotal
    var total = 0;

    $(".sub-total").each(function() {
        total += parseFloat($(this).text());
    });

    //Sum of discount
    var totaldiscount = 0;

    $(".discount-val").each(function() {
        totaldiscount += parseFloat($(this).val());
    });

    //Sum of Tax
    var totaltax = 0;

    $(".tax-val").each(function() {
        totaltax += parseFloat($(this).val());
    });

        console.log(totaldiscount);
  //  console.log('total = ' + total);

    $('input[name="total_price"]').val(total.toFixed(2));

    $('#order-total').text(total.toFixed(2));
    $('#discount-total').text(totaldiscount.toFixed(2));
    $('.discount-total').val(totaldiscount.toFixed(2));
    $('#tax-total').text(totaltax.toFixed(2));
    $('.tax-total').val(totaltax.toFixed(2));
    $('#total-quantity').text(total_qty);
    $('.total-quantity').val(total_qty);

    calculateGrandTotal();
}




function calculateGrandTotal() {

    var item = $('#table-body tr:last').index();

    var total_qty = parseFloat($('input[name="total_qty"]').val());

    var subtotal = parseFloat($('input[name="total_price"]').val());

    var order_tax = parseFloat($('select[name="order_tax_rate"]').val());

   var order_discount = parseFloat($('input[name="order_discount"]').val());

   if (!order_discount)
        order_discount = 0.00;
   $("#discount").text(order_discount.toFixed(2));

   var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

   // console.log('grand total' + grand_total);
  //  console.log('sub total' +subtotal);

    $('input[name="grand_total"]').val(grand_total.toFixed(2));

   // couponDiscount(); 

    var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
    if (!coupon_discount)
        coupon_discount = 0.00;
    grand_total -= coupon_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('#table-body tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#tax').text(order_tax.toFixed(2));
    $('input[name="order_tax"]').val(order_tax.toFixed(2));
    $('#shipping-cost').text(shipping_cost.toFixed(2));
    $('#grand-total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
}


// Update The Product Row

function calculateRowProductData(index) {

    console.log(index);

   var quantity     =  $('#table-body tr:nth-child(' + (index + 1) + ')').find('.qty').val();

   var productprice =  $('#table-body tr:nth-child(' + (index + 1) + ')').find('.product-price').text();

   var discount =  $('#table-body tr:nth-child(' + (index + 1) + ')').find('.discount-val').val();

   var tax =  $('#table-body tr:nth-child(' + (index + 1) + ')').find('.tax-val').val();

    console.log(tax);

   var totalprice = (quantity * productprice) - discount + tax;

    $('#table-body tr:nth-child(' + (index + 1) + ')').find('.sub-total').text(totalprice);

    calculateTotal();

    calculateGrandTotal();

}



 // Choose Tax Type


 $("body").on("change", ".chooseTaxType", function(event) {

    var taxtype = $(this).val();

    var element = $(this).parent().parent();

    $.ajax({

        type: 'POST',
        url: '{{ route("gettaxtype")}}',

        data: {
            "_token": "{{ csrf_token() }}",
            "parent": taxtype,
          },

            success: function(data) {

                console.log(data);

            if (!$.trim(data)){ }
            else{

                var htmls = '';

                jQuery.each(data, function(index, item) {

                    htmls += '<option value="' + item['code'] + '">' + item['code'] + '</option>';

                });

             //    element.find('.subtaxtype').empty().append(htmls);

                $('.subtaxtype').empty().append(htmls);
            }



        },

        error : function(err) {

            console.log(err.responseText);
        },
    });

 });


	</script>

    <script src="{{ asset('main/js/taxes.js')}}"></script>


@endpush
