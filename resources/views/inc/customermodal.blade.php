<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('site.create_customer')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="row g-3" method="POST" action="{{ route('savecustomer') }}">
                @csrf
            <div class="modal-body">


                    <div class="col-12">
                        <label for="inputLastName1" class="form-label">@lang('site.customer-type')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                            <select name="type" required class="form-control border-start-0" id="inputLastName1">
                                <option value="bussiness">@lang('site.bussiness')</option>
                                <option value="pserson">@lang('site.pserson')</option>
                                <option value="foreign">@lang('site.foreign')</option>
                            </select>
                        </div>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="col-12">
                        <label for="inputLastName1" class="form-label">@lang('site.full-name')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                            <input name="name" required value="{{ old('name') }}" type="text" class="form-control border-start-0" id="inputLastName1" placeholder="@lang('site.full-name')" />
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="col-12">
                        <label for="inputPhoneNo" class="form-label">@lang('site.phone')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
                            <input name="phone"  value="{{ old('phone') }}" type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="@lang('site.phone')" />
                        </div>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputEmailAddress" class="form-label">@lang('site.reg-numer')/@lang('site.id')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="reg_numer" required class="form-control border-start-0" id="inputEmailAddress" placeholder="@lang('site.reg-numer')" />
                        </div>
                        @error('reg_numer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="col-6">
                        <label for="Country" class="form-label">@lang('site.Country')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="country" required class="form-control border-start-0" id="Country" placeholder="@lang('site.Country')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="Governorate" class="form-label">@lang('site.Governorate')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="governorate" required class="form-control border-start-0" id="Governorate" placeholder="@lang('site.Governorate')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="City" class="form-label">@lang('site.City')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="city" required class="form-control border-start-0" id="City" placeholder="@lang('site.City')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="street" class="form-label">@lang('site.Street Name')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="street" required class="form-control border-start-0" id="street" placeholder="@lang('site.Street Name')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="building" class="form-label">@lang('site.Building Name/No')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="building" required class="form-control border-start-0" id="building" placeholder="@lang('site.Building Name/No')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="floor" class="form-label">@lang('site.Floor No')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="floor" required class="form-control border-start-0" id="floor" placeholder="@lang('site.Floor No')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="flat" class="form-label">@lang('site.Flat No')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="flat" required class="form-control border-start-0" id="flat" placeholder="@lang('site.Flat No')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="additional" class="form-label">@lang('site.Additional Information')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="additional" required class="form-control border-start-0" id="additional" placeholder="@lang('site.Additional Information')" />
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="post" class="form-label">@lang('site.Postal Code')</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                            <input type="text" name="post" required class="form-control border-start-0" id="post" placeholder="@lang('site.Postal Code')" />
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
