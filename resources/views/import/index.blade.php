@extends('layouts.main')

@section('content')


                        <div class="page-content">

                            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                                <div class="ps-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0 p-0">
                                            <li class="breadcrumb-item">
                                                <a href="{{ url('/') }}"><i class="bx bx-home-alt"></i> @lang('site.dashboard') </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">  @lang('site.import')  </li>
                                        </ol>
                                    </nav>
                                </div>

                            </div>
                            <hr>

{{--
                                        <div class="col">

                                            <div class="card border-top border-0 border-4 border-dark">
                                                <div class="card-body p-5">

                                                    <div class="card-title d-flex align-items-center">
                                                        <div><i class="fadeIn animated bx bx-band-aid me-1 font-22 text-dark"></i>
                                                        </div>
                                                        <h5 class="mb-0 text-dark">استيراد الادويه</h5>
                                                    </div>
                                                    <hr>
                                                    <p class="lead"> اضغط <a href="{{ asset('import/medicines.csv') }}" download> هنا</a> لتحميل الملف <br></p>
                                                    <form class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="inputFirstName" class="form-label">اختر الملف</label>
                                                            <input type="file" class="form-control" id="inputFirstName">
                                                        </div>

                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-dark px-5">استيراد </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col">

                                            <div class="card border-top border-0 border-4 border-info">
                                                <div class="card-body">
                                                    <div class="border p-4 rounded">
                                                        <div class="card-title d-flex align-items-center">
                                                            <div><i class="bx bx-line-chart me-1 font-22 text-info"></i>
                                                            </div>
                                                            <h5 class="mb-0 text-info">استيراد الموظفين</h5>
                                                        </div>
                                                        <hr/>

                                                  <hr>
                                                    <p class="lead"> اضغط <a href="{{ asset('import/doctors.csv') }}" download> هنا</a> لتحميل الملف <br></p>
                                                    <form class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="inputFirstName" class="form-label">اختر الملف</label>
                                                            <input type="file" class="form-control" id="inputFirstName">
                                                        </div>

                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-info px-5">استيراد </button>
                                                        </div>
                                                    </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>  --}}
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
@endsection
