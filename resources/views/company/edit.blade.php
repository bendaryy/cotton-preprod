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
                    <li class="breadcrumb-item active" aria-current="page">@lang("site.apicompany")</li>
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

            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">@lang("site.apicompany")</h5>
                    </div>
                    <hr>

                    <form class="row g-3" method="post" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                         @method('PUT')

                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">@lang("site.name_ar")</label>
                            <input type="text" required class="form-control" id="inputFirstName" name="name_ar" value="{{ $company->name_ar }}">
                        </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">@lang("site.name_en")</label>
                            <input type="text" class="form-control" id="inputLastName" name="name_en" value="{{ $company->name_en }}">
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">@lang("site.reg_num")</label>
                            <input type="text" required class="form-control" id="inputEmail" name="reg_number" value="{{ $company->reg_number  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">@lang("site.email")</label>
                            <input type="email" required class="form-control" id="email" name="email" value="{{ $company->email  }}">
                        </div>

                        <div class="col-md-6">
                            <label for="logo" class="form-label">@lang("site.logo")</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>

                        <div class="col-md-6">
                            <label for="lang" class="form-label">@lang("site.lang")</label>
                            <select class="form-control" id="lang" name="lang">
                                <option @if($company->lang == 'ar') selected @endif value="ar">@lang('site.arabic')</option>
                                <option @if($company->lang == 'en') selected @endif value="en">@lang('site.english')</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">@lang("site.primary_address")</label>
                            <textarea type="file" class="form-control" id="primary_address" required name="primary_address">{{$company->primary_address }}</textarea>
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
