ss
@extends('layouts.main')

@section('content')

<div class="page-content">


    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang('site.dashboard')</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.products')</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('products.index') }}" class="btn btn-outline-success px-5 radius-30">
                    <i class="bx bx-message-square-edit mr-1"></i>@lang('site.back') </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-2">


        <div class="col-md-9">

            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-4">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">@lang("site.create_product")</h5>
                            </div>
                     <div class="col-md-8">
                        <div class="category-data" style="text-align: left">
                        <h6 id="category-status"> </h6>
                        <h6 id="category-title" class="text-success"> </h6>
                        <p id="category-includes"> </p>
                        <p id="category-excludes"> </p>
                        </div>
                        </div>
                    </div>
                    </div>
                    <hr>

                    <form class="row g-3" method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="egs-code" class="form-label">@lang("site.egs-code")</label>
                            <div class="input-group input-group-default"> <span class="input-group-text" id="inputGroup-sizing-default">EG-{{ $setting->commercial_number }}</span>
                                <input name="egs" required type="text" value="{{ $product->code }}" id="egs-code" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                         </div>

                         <div class="col-md-6">
                            <label for="gpc-input" class="form-label">@lang("site.gpc_code") <span class="text-secondary"> 99999999 </span></label>
                             <div class="input-group mb-3">
                                <input type="text" required class="form-control" id="gpc-input" name="gpc" value="{{ $product->gpc }}" aria-describedby="gpc-button">
                                <button class="btn btn-info" type="button" id="gpc-button"><i style="margin-top: -12px;" class="bx bx-search-alt"></i></button>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">@lang("site.name_ar")</label>
                            <input type="text" required class="form-control" id="inputFirstName" name="name_ar" value="{{  $product->name_ar }}">
                        </div>


                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">@lang("site.name_en")</label>
                            <input type="text" class="form-control" id="inputLastName" name="name_en" value="{{  $product->name_en }}" required>
                        </div>

                         <div class="col-md-6">
                            <label for="desc_ar" class="form-label">@lang("site.desc_ar")</label>
                            <input type="text" required class="form-control" id="desc_ar" name="desc_ar" required value="{{  $product->desc_ar }}">
                        </div>


                        <div class="col-md-6">
                            <label for="desc_en" class="form-label">@lang("site.desc_en")</label>
                            <input type="text" class="form-control" id="desc_en" name="desc_en" required value="{{  $product->desc_en }}">
                        </div>

                        <div class="col-md-6">
                            <label for="active_from" class="form-label">@lang("site.active_from")</label>
                            <input type="date" class="form-control" id="active_from" name="active_from" required value="{{  $product->active_from }}">
                        </div>
                        <div class="col-md-6">
                            <label for="active_to" class="form-label">@lang("site.active_to")</label>
                            <input type="date" class="form-control" id="desc_en" name="active_to" value="{{  $product->active_to }}">
                        </div>

                        <div class="col-md-6">
                            <label for="active_to" class="form-label">@lang("site.price")</label>
                            <div class="input-group mb-3"> <span class="input-group-text">$</span>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{  $product->price }}" name="price" required> <span class="input-group-text">.00</span>
                            </div>

                        </div>

                        <div class="col-12">
                            <button type="submit" id="submit" class="btn btn-primary px-5">@lang('site.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>

@endsection

@push('js')

<script>


    $("#gpc-button").on('click', function () {

        var code = $("#gpc-input").val();

        $.ajax({

            type: 'POST',
            url: '{{ route("getcategory")}}',

            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
              },

            success: function(data) {



                if (!$.trim(data)){

                    $("#category-title").text('No Category');

                    $("#gpc-input").css('border-color', 'red');

                    $("#submit").attr("disabled", "disabled").button('refresh');


                }
                else{

                    $("#category-title").text(data['title']);
                    $("#category-excludes").text(data['excludes']);
                    $("#category-includes").text(data['includes']);
                    $("#gpc-input").css('border-color', 'green');
                    $("#submit").removeAttr("disabled").button('refresh');


                }



            },

            error : function(err) {

                console.log(err.responseText);
            },
        });
    });

</script>


<script>

    $(window).on('load', function () {
        var code = $("#gpc-input").val();

        $.ajax({

            type: 'POST',
            url: '{{ route("getcategory")}}',

            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
              },

            success: function(data) {



                if (!$.trim(data)){

                    $("#category-title").text('No Category');

                    $("#gpc-input").css('border-color', 'red');

                    $("#submit").attr("disabled", "disabled").button('refresh');


                }
                else{

                    $("#category-title").text(data['title']);
                    $("#category-excludes").text(data['excludes']);
                    $("#category-includes").text(data['includes']);
                    $("#gpc-input").css('border-color', 'green');
                    $("#submit").removeAttr("disabled").button('refresh');


                }



            },

            error : function(err) {

                console.log(err.responseText);
            },
        });
    });

</script>

@endpush
