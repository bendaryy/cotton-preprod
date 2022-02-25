@extends('layouts.main')

@section('content')

<div class="page-content">


    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang("site.dashboard")</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">   @lang("site.issure_file")</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('issure.index') }}" class="btn btn-outline-success px-5 radius-30">
                    <i class="bx bx-message-square-edit mr-1"></i>@lang('site.back') </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-2">


        <div class="col-md-9">

            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">@lang("site.issure_file")</h5>
                    </div>
                    <hr>

                    <form class="row g-3" method="post" action="{{ route('issure.update', $issure->id) }}" enctype="multipart/form-data">
                        @csrf
                         @method('PUT')

                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">@lang("site.name")</label>
                            <input type="text"   class="form-control" id="inputFirstName" name="name" value="{{ $issure->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="branchID" class="form-label">@lang("site.branchID")</label>
                            <input type="text" class="form-control" id="branchID" name="branchID" value="{{ $issure->branchID }}">
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">@lang("site.country")</label>


                            <select class="form-control" id="type" name="country">

                                <option disabled> @lang('site.choose')</option>

                                @foreach($countries as $country)

                                <option @if($issure->country == $country->code) selected @endif value="{{ $country->code}}">
                                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                                    {{ $country->code}} {{ $country->Desc_en}}
                                    @else
                                    {{ $country->code}} {{ $country->Desc_ar}}
                                    @endif </option>
                                @endforeach

                            </select>


                        </div>

                        <div class="col-md-6">
                            <label for="governate" class="form-label">@lang("site.governate")</label>
                            <input type="text"   class="form-control" id="governate" name="governate" value="{{ $issure->governate  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="regionCity" class="form-label">@lang("site.regionCity")</label>
                            <input type="text"   class="form-control" id="regionCity" name="regionCity" value="{{ $issure->regionCity  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="street" class="form-label">@lang("site.street")</label>
                            <input type="text"   class="form-control" id="street" name="street" value="{{ $issure->street  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="buildingNumber" class="form-label">@lang("site.buildingNumber")</label>
                            <input type="text"   class="form-control" id="buildingNumber" name="buildingNumber" value="{{ $issure->buildingNumber  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="postalCode" class="form-label">@lang("site.postalCode")</label>
                            <input type="text"   class="form-control" id="street" name="postalCode" value="{{ $issure->postalCode  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="floor" class="form-label">@lang("site.floor")</label>
                            <input type="text"   class="form-control" id="floor" name="floor" value="{{ $issure->floor  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="room" class="form-label">@lang("site.room")</label>
                            <input type="text"   class="form-control" id="room" name="room" value="{{ $issure->room  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="landmark" class="form-label">@lang("site.landmark")</label>
                            <input type="text"   class="form-control" id="room" name="landmark" value="{{ $issure->landmark  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="additionalInformation" class="form-label">@lang("site.additionalInformation")</label>
                            <input type="text"   class="form-control" id="additionalInformation" name="additionalInformation" value="{{ $issure->additionalInformation  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label">@lang("site.type")</label>
                            <select class="form-control" id="type" name="type">
                                <option value="B" @if ($issure->type == 'B')  selected @endif> @lang('site.bussiness')</option>
                                <option value="P" @if ($issure->type == 'P')  selected @endif> @lang('site.pserson')</option>
                                <option value="F" @if ($issure->type == 'F')  selected @endif> @lang('site.foreign')</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="regid" class="form-label">@lang("site.regid")</label>
                            <input type="text"   class="form-control" id="regid" name="regid" value="{{ $issure->regid  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="activecode" class="form-label">@lang("site.activecode")</label>

                            <select class="form-control" id="type" name="activecode">

                                <option disabled > @lang('site.choose')</option>

                                @foreach($activity as $act)

                                <option @if($issure->activecode ==  $act->code) selected @endif value="{{ $act->code}}">
                                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                                    {{ $act->code}} {{ $act->Desc_en}}
                                    @else
                                    {{ $act->code}} {{ $act->Desc_ar}}
                                    @endif </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">@lang('site.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>

@endsection
