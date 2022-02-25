<div class="modal fade" id="taxmodal" tabindex="-1" aria-labelledby="taxmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taxmodalLabel">@lang('site.create_customer')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="row g-3" method="POST" action="{{ route('savecustomer') }}">
                @csrf
            <div class="modal-body">


                    <div class="col-12">
                        <label for="inputLastName1" class="form-label">@lang('site.customer-type')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                            <select name="type" required class="form-control border-start-0 chooseTaxType" id="inputLastName1">

                                <option selected disabled>@lang('site.choose_tax')</option>

                                @foreach ($taxtypes as $taxtype)

                                <option value="{{ $taxtype->code }}">{{ $taxtype->code }}</option>

                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="col-12">
                        <label for="inputLastName1" class="form-label">@lang('site.customer-type')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                            <select name="type" required class="form-control border-start-0 subtaxtype" id="inputLastName1">

                            </select>
                        </div>

                    </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
            </div>
        </form>
        </div>
    </div>
</div>
