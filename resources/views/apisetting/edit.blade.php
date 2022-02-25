@extends('layouts.main')

@section('content')

<div class="page-content">


    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@lang("site.settings")</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@lang("site.apisetting")</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('setting.index') }}" class="btn btn-outline-success px-5 radius-30">
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
                        <h5 class="mb-0 text-primary">@lang("site.apisetting")</h5>
                    </div>
                    <hr>

                    <form class="row g-3" method="post" action="{{ route('setting.update', $setting->id) }}">
                        @csrf
                         @method('PUT')

                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">@lang("site.name")</label>
                            <input type="text" required class="form-control" id="inputEmail" name="company_name"
                                value="{{ $setting->company_name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">@lang("site.governate")</label>
                            <input type="text" required class="form-control" id="inputEmail" name="governate"
                                value="{{ $setting->governate }}">
                        </div>

                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">@lang("site.client_id")</label>
                            <input type="text" required class="form-control" id="inputFirstName" name="client_id" value="{{ $setting->client_id }}">
                        </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">@lang("site.secret_id")</label>
                            <input type="text" class="form-control" id="inputLastName" name="client_secret" value="{{ $setting->client_secret }}">
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">@lang("site.commerial_num")</label>
                            <input type="text" required class="form-control" id="inputEmail" name="company_id" value="{{ $setting->company_id }}">
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
