ss
@extends('layouts.main')

@section('content')

    <div class="page-content">


        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@lang("site.Document Packages")</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang("site.New Package")</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('company.index') }}" class="btn btn-outline-success px-5 radius-30">
                        <i class="bx bx-message-square-edit mr-1"></i>@lang('site.back') </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row row-cols-1 row-cols-2">
            <div class="col-md-9">

                            @if (session()->has('success'))
                                <div class="alert alert-success" style="margin: auto;text-align:center">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger" style="margin: auto;text-align:center">
                                    {{ session()->get('error') }}
                                </div>
                            @endif

                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-4">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                    <h5 class="mb-0 text-primary">@lang("site.New Package")</h5>
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

                        <form class="row g-3" method="post" action="{{ route('sendFullPackage') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <label for="gpc-input" class="form-label">@lang("site.Choose Package Extention") <span
                                        class="text-secondary"></span></label>
                                <select name="format" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected disabled>@lang("site.Choose Package Extention")</option>
                                    <option value="JSON">json</option>
                                    <option value="XML">xml</option>
                                </select>

                            </div>

                            <div class="col-md-6">
                                <label for="gpc-input" class="form-label">@lang("site.Choose Package Type") <span
                                        class="text-secondary"></span></label>
                                <select name="status" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected disabled>@lang("site.Choose Package Type")</option>
                                    <option value="Valid">@lang("site.Valid")</option>
                                    <option value="Invalid">@lang("site.Invalid")</option>
                                    <option value="Rejected">@lang("site.Rejected")</option>
                                    <option value="Cancelled">@lang("site.Cancelled")</option>
                                </select>
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="gpc-input" class="form-label"> نوع العميل <span
                                        class="text-secondary"></span></label>
                                <select name="receiverSenderType" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected disabled>نوع العميل</option>
                                    <option value="0">شركة</option>
                                    <option value="1">شخص</option>
                                    <option value="2">اجنبى</option>
                                </select>
                            </div> --}}



                            <div class="col-md-6">
                                <label for="active_from" class="form-label">@lang("site.Date From")</label>
                                <input name="dateFrom" type="date" class="form-control" id="active_from"
                                    name="active_from" required value="">
                            </div>
                            <div class="col-md-6">
                                <label for="active_to" class="form-label">@lang("site.Date To")</label>
                                <input name="dateTo" type="date" class="form-control" id="desc_en" name="active_to"
                                    value="">
                            </div>
                            {{-- <div class="col-md-6">
                            <label for="active_to" class="form-label">@lang("site.price")</label>
                            <div class="input-group mb-3"> <span class="input-group-text">$</span>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                                    value="{{ old('price') }}" name="price"> <span class="input-group-text">.00</span>
                            </div>

                        </div> --}}


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
