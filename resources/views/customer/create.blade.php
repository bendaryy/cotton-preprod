@extends('layouts.main')


@section('content')
<style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
.select2-container{
    padding:30px
}
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang('site.customers')</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.create-customer')</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-2">


        <div class="col-md-9">

            <hr/>
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                        </div>
                        <h5 class="mb-0 text-info">@lang('site.create-customer')</h5>
                    </div>
                    <hr>

                    <form class="row g-3" method="POST" action="{{ route('customer.store') }}">
                        @csrf

                         {{-- <div class="col-12">
                            <label for="inputLastName1" class="form-label">@lang('site.customer-type')</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                <select name="type"   class="form-control border-start-0" id="inputLastName1">
                                    <option value="bussiness">@lang('site.bussiness')</option>
                                    <option value="pserson">@lang('site.pserson')</option>
                                    <option value="foreign">@lang('site.foreign')</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-12">
                            <label for="inputLastName1" class="form-label">@lang('site.full-name')</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                <input name="name" required type="text" class="form-control border-start-0" id="inputLastName1" placeholder="@lang('site.full-name')" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="inputPhoneNo" class="form-label">الرقم القومى/ رقم التسجيل الضريبى</label>
                            {{-- <label for="inputPhoneNo" class="form-label">@lang('site.phone')</label> --}}
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
                                <input name="tax_id" required required value="{{ old('tax_id') }}" type="number" class="form-control border-start-0" id="tax_id" placeholder="الرقم القومى/ رقم التسجيل الضريبى" />
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">@lang('site.reg-numer')/@lang('site.id')</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" name="tax_id"   class="form-control border-start-0" id="inputEmailAddress" placeholder="@lang('site.reg-numer')" />
                            </div>
                        </div> --}}

                        <div class="col-6">
                            <label for="Country" class="form-label">@lang('site.Country')</label>

                            <select class="form-control single-select" required style="width: 300px;" id="type" name="country">

                                <option disabled selected>اختر الدولة</option>

                                @foreach($countries as $country)

                                <option value="{{ $country->code}}">
                                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                                    {{ $country->code}} {{ $country->Desc_en}}
                                    @else
                                    {{ $country->code}} {{ $country->Desc_ar}}
                                    @endif </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="col-6">
                            <label for="Governorate" class="form-label">@lang('site.Governorate')</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" required name="governate"  class="form-control border-start-0" id="Governorate" placeholder="@lang('site.Governorate')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="City" class="form-label">@lang('site.City')</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" required name="regionCity" class="form-control border-start-0" id="City" placeholder="@lang('site.City')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="street"  class="form-label">اسم الشارع</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" required name="street" class="form-control border-start-0" id="street" placeholder="@lang('site.Street Name')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="building" class="form-label">@lang('site.Building Name/No') </label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" required name="buildingNumber"  class="form-control border-start-0" id="building" placeholder="@lang('site.Building Name/No')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="floor" class="form-label">@lang('site.Floor No') (اختيارى)</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text"  name="floor"   class="form-control border-start-0" id="floor" placeholder="@lang('site.Floor No')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="flat" class="form-label">@lang('site.Flat No')(اختيارى)</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" name="room"  class="form-control border-start-0" id="flat" placeholder="@lang('site.Flat No')" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="additional" class="form-label">@lang('site.Additional Information') (اختيارى)</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" name="additionalInformation"   class="form-control border-start-0" id="additional" placeholder="@lang('site.Additional Information')" />
                            </div>
                        </div>


                        <div class="col-6">
                                <label for="flat" class="form-label">معلم معروف(اختيارى)</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message'></i></span>
                                    <input type="text" name="landmark" class="form-control border-start-0" id="landmark"
                                        placeholder="معلم معروف" />
                                </div>
                            </div>

                        <div class="col-6">
                            <label for="post" class="form-label">@lang('site.Postal Code') (اختيارى)</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
                                <input type="text" name="postalCode"   class="form-control border-start-0" id="post" placeholder="@lang('site.Postal Code')" />
                            </div>
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-info px-5">@lang('site.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>


@endsection
