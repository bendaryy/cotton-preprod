@extends('layouts.main')

@section('content')


    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="bx bx-home-alt"></i> @lang('site.dashboard') </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang('site.profile')</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset('images/' . $user->avatar )}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110">
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>


                                    </div>
                                </div>
                                <hr class="my-4" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('updateprofile') }}" enctype="multipart/form-data">
                                    @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">@lang('site.name')</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">   @lang('site.email')</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">@lang('site.avatar')</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="avatar" class="form-control" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="@lang('site.save')" />
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
