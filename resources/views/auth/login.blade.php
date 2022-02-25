


 <!doctype html>
 <html lang="en" dir="rtl">


 <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="{{ asset('main/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('main/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('main/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" />
	<link href="{{ asset('main/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
	<link href="{{ asset('main/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('main/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('main/css/pace.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('main/plugins/notifications/css/lobibox.min.css')}}" />
	<script src="{{ asset('main/js/pace.min.js')}}"></script>
	<link href="{{ asset('main/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('main/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('main/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('main/css/icons.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('main/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{ asset('main/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{ asset('main/css/header-colors.css')}}" />

 </head>

 <body>
     <!--wrapper-->
     <div class="wrapper">
         <div class="authentication-header"></div>
         <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
             <div class="container-fluid">
                 <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                     <div class="col mx-auto">
                         <div class="mb-4 text-center">
                             <img src="{{ asset('images/logo-img.png')}}" width="180" alt="" />
                         </div>
                         <div class="card">
                             <div class="card-body">
                                 <div class="p-4 rounded">
                                     <div class="text-center">
                                         <h3 class="">@lang('site.login')</h3>

                                     </div>

                                     <div class="form-body">
                                         <form class="row g-3" method="post" action="{{ route('login') }}">
                                             @csrf


                                             <div class="col-12">
                                                 <label for="inputEmailAddress" class="form-label">@lang('site.email')</label>
                                                 <input type="email" class="form-control" name="email" required id="inputEmailAddress" placeholder="@lang('site.email')">
                                             </div>

                                             <div class="col-12">
                                                 <label for="inputChoosePassword" class="form-label">@lang('site.password')</label>
                                                 <div class="input-group" id="show_hide_password">
                                                     <input type="password" name="password" required class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="@lang('site.login')">
                                                     <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                 </div>
                                             </div>

                                             <div class="col-md-6">
                                                 <div class="form-check form-switch">
                                                     <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                     <label class="form-check-label" for="flexSwitchCheckChecked">@lang('site.remomber')</label>
                                                 </div>
                                             </div>
                                             <div class="col-md-6 text-end">
                                                 	<a href="">@lang('site.forgot')</a>
                                             </div>
                                             <div class="col-12">
                                                 <div class="d-grid">
                                                     <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>@lang('site.login')</button>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--end row-->
             </div>
         </div>
     </div>
 
     <script src="{{ asset('main/js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{ asset('main/js/jquery.min.js')}}"></script>
     <script src="{{ asset('main/plugins/simplebar/js/simplebar.min.js')}}"></script>
     <script src="{{ asset('main/plugins/metismenu/js/metisMenu.min.js')}}"></script>
     <script src="{{ asset('main/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    
     <script>
         $(document).ready(function () {
             $("#show_hide_password a").on('click', function (event) {
                 event.preventDefault();
                 if ($('#show_hide_password input').attr("type") == "text") {
                     $('#show_hide_password input').attr('type', 'password');
                     $('#show_hide_password i').addClass("bx-hide");
                     $('#show_hide_password i').removeClass("bx-show");
                 } else if ($('#show_hide_password input').attr("type") == "password") {
                     $('#show_hide_password input').attr('type', 'text');
                     $('#show_hide_password i').removeClass("bx-hide");
                     $('#show_hide_password i').addClass("bx-show");
                 }
             });
         });

     <script src="{{ asset('main//js/app.js')}}"></script>
 </body>


 </html>
 