<div class="modal fade" id="exampleFullScreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <form class="row g-3" id="addnewprodform" method="post" action="{{ route('storeproduct') }}" enctype="multipart/form-data">
                @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add New Line </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            <div class="modal-body">
                <input type="hidden" name="order_id" value="{{ $order->id }}">

   <div class="container">
      <div class="row">
              <div class="col-md-6">
                <div class="border border-3 p-4 rounded">
                  <div class="col-md-12">
                    <label class="form-label">@lang('site.product')</label>

                    <select class="form-control" id="choose-product" name="product_id">

                        @foreach ($products as $product)
                        @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <option value="{{ $product->id }}"> {{ $product->name_en }}</option>
                        @else
                        <option value="{{ $product->id }}"> {{ $product->name_ar }}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                    <br>
                 <div class="col-md-12">
                    <label class="form-label" for="unittype">@lang('site.type')</label>

                    <select class="form-control" id="unittype" name="unittype">

                        @foreach ($unittype as $type)

                        <option value="{{ $type->code }}"> {{ $type->desc_en }}</option>

                        @endforeach
                    </select>
                 </div>
              </div>

              <br>

              <div class="row">

                 <div class="col-md-6">
                    <label for="inputFirstName" class="form-label">@lang("site.quantity")</label>
                    <input type="text" required class="form-control lineqty" onkeyup="calculatelinedata()" id="inputFirstName" name="qty" value="{{ old('quantity') }}">
                </div>


                <div class="col-md-6">
                    <label for="active_to" class="form-label">@lang("site.price")</label>
                    <div class="input-group mb-3"> <span class="input-group-text">$</span>
                        <input type="number" class="form-control lineprice" onkeyup="calculatelinedata()" name="price" value="{{ old('price') }}" required> <span class="input-group-text">.00</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="active_to" class="form-label">@lang("site.discount")</label>
                    <div class="input-group mb-3"> <span class="input-group-text">$</span>
                        <input type="number" class="form-control linediscount" onkeyup="calculatelinedata()" aria-label="Amount (to the nearest dollar)" name="discount" required> <span class="input-group-text">.00</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="active_to" class="form-label">@lang('site.total sales amount')</label>
                    <div class="input-group mb-3"> <span class="input-group-text">$</span>
                        <input type="text" disabled class="form-control linetotal" aria-label="Amount (to the nearest dollar)" name="total">  </span>
                        <input type="hidden" class="form-control linetotal" aria-label="Amount (to the nearest dollar)" name="total"  required>  </span>
                    </div>
                </div>


                <div class="col-md-12">
                    <label for="active_to" class="form-label"> @lang('site.Item Descreption') </label>
                    <div class="input-group mb-3">
                        <textarea type="number" class="form-control" name="descreption" required></textarea>
                    </div>
                </div>

              </div>
              </div>
              <div class="col-md-6">

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>@lang('site.type') </th>
                                <th>@lang('site.subtype')</th>
                                <th>@lang("site.amount") 0.00</th>
                                <th>@lang("site.percentage") % </th>
                                <th> </th>
                            </tr>
                        </thead>

                        <tbody id="taxtablebody">
                            <tr data-id="0">
                                <td>
                                    <select name="type[]" required class="form-control  chooseTaxType"  id="inputLastName1">

                                    <option selected disabled>@lang('site.choose_tax')</option>

                                    @foreach ($taxtypes as $taxtype)

                                    <option value="{{ $taxtype->code }}">{{ $taxtype->code }}</option>

                                    @endforeach

                                </select>
                             </td>
                                <td>

                                    <div class="input-group">
                                        <select name="subtype[]" required class="form-control subtaxtype" id="inputLastName"></select>
                                    </div>
                                </td>
                                <td>

                                    <input type="text" name="amount[]" required class="form-control" id="inputFirstName">
                                </td>
                                <td>

                                    <input type="text" required class="form-control" id="percentage" name="percentage[]">
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <a href="" class="add-newtax"> Add New Tax </a>
            </div>

              </div>

            </div>    {{--  End OF Container  --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="addproductbtn" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </form>
            </div>
            </div>
        </div>




@push('js')




<script>




    $(".add-newtax").on('click', function(e){

        e.preventDefault();


        var rownumber = $('#taxtablebody tr:last').index();

        var index = rownumber + 1;

        var cols = '';
        var newRow = $("<tr data-id='" + index +"'>");
        cols +='<td><select name="type[]" required class="form-control  chooseTaxType"  id="inputLastName1"><option selected disabled>@lang('site.choose_tax')</option>@foreach ($taxtypes as $taxtype)<option value="{{ $taxtype->code }}">{{ $taxtype->code }}</option>@endforeach</select></td>';
        cols +='<td><div class="input-group"><select name="subtype[]" required class="form-control subtaxtype" id="inputLastName"></select></div></td>';
        cols +='<td><input type="text" name="amount[]" required class="form-control" id="inputFirstName"></td>';
        cols +='<td><input type="text" required class="form-control" id="percentage" name="percentage[]"></td>';
        cols +='<td><button class="btn btn-outline-danger ibtnDel"><i class="bx bxs-trash me-0"></i></button></td></tr>';

        newRow.append(cols);

        $("#taxtablebody").append(newRow);

    });




</script>

@endpush
