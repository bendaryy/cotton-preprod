@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function randomTest(){
       var internalValue =  document.getElementById('internalId') ;
        internalValue.value = Math.floor(Math.random()*105140 );
    }
</script>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>الفاتورة الإلكترونية </title>
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
<link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">




<style>
    th,
    td,
    tr,
    table {
        padding: 5px;
        text-align: center;
    }

    .borderNone {
        border: none
    }

    .borderNone:focus {
        outline: none;
    }

    .online-actions {
        display: none;
    }

    .navbar-expand-sm {
        justify-content: center
    }

    input[type="number"] {
        width: 130;
        text-align: center
    }

    input[name="totalItemsDiscount[]"],
    input[name="totalAmount2"],
    input[name="totalAmount"] {
        width: 250;
    }

    input[readonly] {
        background-color: #ccc
    }

    hr {
        border: 4px solid orange;
    }
</style>





@section('content')
<h2 style="text-align: center">

    انشاء فاتورة جديدة
</h2>
@if(request()->routeIs('createInvoice'))
<a href="{{ route('customer.create') }}" class="btn btn-info" style="margin-right: 50px">
    اضافة عميل
</a>
<form action="{{route('createInvoice2')}}" method="GET">
    <div class="card col-md-6 text-center" style="margin: auto;margin-bottom: 50px">
        <div class="card-body">
            <div class="border p-3 rounded">
                <div class="mb-3">
                    <label class="form-label">اختر اسم الشركة</label>
                    <select class="single-select" name="receiverName" class="form-control" id="receiverName">
                        <option selected disabled>اختر اسم الشركة</option>
                        @foreach ($allCompanies as $companies)
                        <option value="{{ $companies->id }}" class="form-control">{{ $companies->name }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="text-align: center">
        <button type="submit" class="btn btn-success">ملئ بيانات الشركة</button>
    </div>
</form>
@else
<div style="text-align: center">
    <a href="{{ route('createInvoice') }}" class="btn btn-success" style="text-align: center">الرجوع لاختيار
        الشركة</a>
</div>
@endif


<div style="margin-bottom: 50px">
    <form method="POST" action="{{ route('storeInvoice') }}">
        @method("POST")
        @csrf

        <div class="row justify-content-center">



            <div class="col-xl-5 invoice-address-client">

                <h3 style="text-align: center;margin:40px">الفاتورة الى</h3>


                <div class="form-group row invoice-created-by">
                    <label for="payment-method-country" class="form-label">نوع
                        المتلقى</label>
                    <div class="col-sm-9">
                        <select name="receiverType" class="form-control form-control-sm form-select">
                            <option value="B" style="font-size: 20px">أعمال</option>
                            <option value="P" style="font-size: 20px">شخص</option>
                            <option value="F" style="font-size: 20px">أجنبى</option>

                        </select>
                    </div>
                </div>

                @if(request()->routeIs('createInvoice2'))
                @foreach ($companiess as $com)
                <div class="form-group row">
                    <label class="form-label">اسم الشركة</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm text-center" name="receiverName"
                            placeholder="اسم الشركة" value="{{ $com->name }}">
                    </div>
                </div>



                <div class="invoice-address-client-fields">
                    <div class="form-group row">
                        <label class="form-label">الرقم الضريبى / الرقم القومى</label>
                        <div class="col-sm-9">
                            <input type="number" style="width:350px" class="form-control form-control-sm text-center"
                                name="receiverId" placeholder="الرقم الضريبى" value="{{ $com->tax_id }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label">اسم البلد</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverCountry"
                                placeholder="اسم البلد" value="{{ $com->country }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label">اسم المحافظة</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverGovernate"
                                placeholder="اسم المحافظة" value="{{ $com->governate }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label">اسم المنطقة</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="receiverRegionCity" placeholder="اسم المنطقة" value="{{ $com->regionCity }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label">اسم الشارع </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="street"
                                placeholder="الشارع" value="{{ $com->street }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label">رقم المبنى</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="receiverBuildingNumber" placeholder="رقم المبنى"
                                value="{{ $com->buildingNumber }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="form-label"> الرقم البريدى (اختيارى)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="receiverPostalCode" placeholder="الرقم البريدى (اختيارى) "
                                value="{{ $com->postalCode }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="form-label"> الدور (اختيارى)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverFloor"
                                placeholder="  (اختيارى) الدور" value="{{ $com->floor }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label"> الغرفة (اختيارى)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverRoom"
                                placeholder="(اختيارى) الغرفة" value="{{ $com->room }}">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="form-label"> علامة مميزة (اختيارى)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverLandmark"
                                placeholder="(اختيارى) علامة مميزة" value="{{ $com->landmark }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label"> بيانات إضافية (اختيارى)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="receiverAdditionalInformation" placeholder="(اختيارى) بيانات إضافية "
                                value="{{ $com->additionalInformation }}">
                        </div>
                    </div>


                    @endforeach
                    @else
                    <div class="form-group row">
                        <label class="form-label">اسم الشركة</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm text-center" name="receiverName"
                                placeholder="اسم الشركة">
                        </div>
                    </div>

                    <div class="invoice-address-client-fields">
                        <div class="form-group row">
                            <label class="form-label">الرقم الضريبى / الرقم القومى</label>
                            <div class="col-sm-9">
                                <input type="number" style="width:350px"
                                    class="form-control form-control-sm text-center" name="receiverId"
                                    placeholder="الرقم الضريبى">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label">اسم البلد</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverCountry" placeholder="اسم البلد">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label">اسم المحافظة</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverGovernate" placeholder="اسم المحافظة">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label">اسم المنطقة</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverRegionCity" placeholder="اسم المنطقة">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label">اسم الشارع </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="street"
                                    placeholder="الشارع">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label">رقم المبنى</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverBuildingNumber" placeholder="رقم المبنى">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label"> الرقم البريدى (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverPostalCode" placeholder="الرقم البريدى (اختيارى) ">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label"> الدور (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="receiverFloor"
                                    placeholder="  (اختيارى) الدور">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> الغرفة (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="receiverRoom"
                                    placeholder="(اختيارى) الغرفة">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label"> علامة مميزة (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverLandmark" placeholder="(اختيارى) علامة مميزة">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> بيانات إضافية (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="receiverAdditionalInformation" placeholder="(اختيارى) بيانات إضافية ">
                            </div>
                        </div>



                        @endif



                        <hr>
                        <h6 style="text-align: center;">جميع بيانات البنك إختيارية</h6>


                        <div class="form-group row">
                            <label class="form-label"> اسم البنك (اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="bankName"
                                    placeholder="  (اختيارى) اسم البيك">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label"> عنوان البنك(اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="bankAddress"
                                    placeholder="  (اختيارى)عنوان البيك">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> رقم الحساب البنكى(اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="bankAccountNo"
                                    placeholder="  (اختيارى)رقم الحساب البنكى">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> IBAN الحساب البنكى(اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center"
                                    name="bankAccountIBAN" placeholder="  (اختيارى)IBAN الحساب البنكى">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> رمز السرعة(اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="swiftCode"
                                    placeholder="  (اختيارى)رمز السرعة">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label"> المصطلحات(اختيارى)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm text-center" name="Bankterms"
                                    placeholder="  (اختيارى)المصطلحات">
                            </div>
                        </div>




                        <hr>




                        <div class="form-group row invoice-created-by">
                            <label for="payment-method-country" class="form-label">
                                كود النشاط الضريبى</label>
                            <div class="col-sm-9">
                                <select name="taxpayerActivityCode" class="form-select">

                                    @foreach ($ActivityCodes as $code)
                                    <option value="{{ $code->code }}"> {{ $code->Desc_ar }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>






                        <div class="form-group row invoice-created-by">
                            <label for="payment-method-country" class="form-label">نوع
                                الوثيقة
                            </label>
                            <div class="col-sm-9">
                                <select name="DocumentType" class="form-control form-control-sm form-select">
                                    <option value="I" selected>فاتورة</option>
                                    <option value="C">إشعار دائن</option>
                                    <option value="D">إشعار مدين</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label">الرقم الداخلى للفاتورة</label>
                            <div class="col-sm-9" style="display: inline-block">
                                <input type="text" class="form-control form-control-sm text-center" id="internalId"
                                    name="internalId" placeholder="الرقم الداخلى للفاتورة">
                            </div>
                            <div class="col-sm-2">
                                <button onClick="randomTest();" class="btn btn-info" type="button">generate</button>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="form-label"> تاريخ الفاتورة</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ date(" Y-m-d") }}"
                                    class="form-control form-control-sm text-center" name="date" placeholder="">
                            </div>
                        </div>

                    </div>

                </div>


            </div>
            <hr style="border: 1px solid white;margin:50px 20px">

            <div id="newOne">

                <table style="margin: auto;width: 90%;" border="1">
                    <tr style="margin: 20px;text-align:center">
                        <td colspan="8" style="margin: 20px;text-align:center;margin-right: 50px">
                            <label for="invoice-detail-notes"
                                class="text-center col-sm-12 col-form-label col-form-label-sm"
                                style="text-align: center">وصف
                                المنتج 1</label>
                            <textarea class="form-control" name="invoiceDescription[]"
                                placeholder="وصف تفصيلى  للمنتج 1"
                                style="height: 88px;width: 360px;text-align: center;margin:auto;margin-top: 20px;margin-bottom: 20px"></textarea>
                        </td>
                    </tr>
                    <tr>

                        <th>قيمة الضريبة %</th>
                        <th>رمز الصنف</th>
                        <th>قيمة ضريبة المنبع %(t4)</th>
                        <th>الكمـــية</th>
                        <th>المبلغ بالجنيه المصرى</th>
                        <th>الخصـــم</th>
                        <th>خصم الصنف (بعد الضريبة)</th>
                    </tr>
                    <tr>
                        <td>
                            {{-- <select name="rate[]" id="rate" class="form-control form-control-sm"
                                onkeyup="findTotalt2Amount()" onmouseover="findTotalt2Amount()">
                                <option value=14 selected>14%</option>
                                <option value=0>0%</option>
                            </select> --}}


                            <input type="text" name="rate[]" id="rate" class="form-control form-control-sm"
                                onkeyup="findTotalt2Amount()" onmouseover="findTotalt2Amount()">

                            <select name="t1subtype[]" required id="t1subtype"
                                class="form-control form-control-sm form-select mt-2" style="width: 150px">
                                <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة (t1)
                                </option>
                                @foreach ($taxTypes as $type)
                                @if($type->parent === "T1")
                                <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">{{
                                    $type->name_ar }}

                                    @endif
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="itemCode[]" id="itemCode" class="form-control form-control-sm form-select">
                                <option disabled selected>اختر النشاط</option>
                                @foreach ($products as $product)
                                <option value="{{ $product['itemCode'] }}" style="font-size: 20px">
                                    {{$product['codeNameSecondaryLang']}}
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" width="1px" name="t4rate[]" id="t4rate" onkeyup="findTotalt4Amount()"
                                onmouseover="findTotalt4Amount()" style="margin-bottom: 5px">
                            <select name="t4subtype[]" required id="t4subtype"
                                class="form-control form-control-sm form-select" style="width: 150px">
                                <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة (t4)
                                </option>
                                @foreach ($taxTypes as $type)
                                @if($type->parent === "T4")
                                <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">{{
                                    $type->name_ar }}

                                    @endif
                                    @endforeach
                            </select>
                        </td>
                        <td><input type="number" step="any" name="quantity[]" id="quantity"
                                onkeyup="proccess(this.value),findTotalSalesAmount();"
                                onmouseover="proccess(this.value),findTotalSalesAmount();"></td>
                        <td><input type=number step="any" name="amountEGP[]" id="amountEGP"
                                onkeyup="operation(this.value),findTotalSalesAmount();;"
                                onmouseover="operation(this.value),findTotalSalesAmount();;"></td>
                        <td><input type="number" step="any" name="discountAmount[]" id="discountAmount"
                                onkeyup="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"
                                onmouseover="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()">
                        </td>
                        <td><input type="number" step="any" name="itemsDiscount[]" id="itemsDiscount"
                                onkeyup="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                                onmouseover="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()">
                        </td>

                    </tr>
                    <tr>
                        <th>قيمة الضريبة (النسبية) </th>
                        <th> قيمة ضريبة (المنبع) </th>
                        <th>إجمالي المبيعات</th>
                        <th>الإجمالى الصافى</th>
                        <th colspan="3">الإجمالى</th>
                    </tr>
                    <tr>
                        <td> <input type="number" step="any" name="t2Amount[]" readonly id="t2"
                                onkeyup="findTotalt2Amount()" onmouseover="findTotalt2Amount()">
                        </td>
                        <td> <input type="number" step="any" name="t4Amount[]" readonly id="t4Amount"
                                onkeyup="findTotalt4Amount()" onmouseover="findTotalt4Amount()">

                        </td>
                        <td><input type=number step="any" name="salesTotal[]" readonly id="salesTotal"></td>
                        <td><input type="number" step="any" readonly name="netTotal[]" id="netTotal"
                                onkeyup="nettotal(this.value),findTotalNetAmount()"
                                onmouseover="nettotal(this.value),findTotalNetAmount()"></td>
                        <td colspan="3"><input type="number" step="any" name="totalItemsDiscount[]" readonly
                                id="totalItemsDiscount" onkeyup="findTotalAmount()" onmouseover="findTotalAmount()">
                    </tr>

                </table>
                <hr>
            </div>
            <div style="z-index:1;text-align: center">

                <button type="button" class="rounded-sm btn btn-info" style="width: 200px" id="addNewOne">إضافــة
                    صــنف</button>

            </div>
            <br style="margin-bottom: 50px">
            <table border="1" style="margin:auto;margin-top: 20px">
                <tr>
                    <th style="margin-top: 30px">إجمالى ضريبة المنبع</th>
                    <th style="margin-top: 30px">إجمالى الضريبة النسبية</th>
                    <th style="margin-top: 30px">إجمالى مبلغ الخصم</th>
                    <th style="margin-top: 30px">إجمالى مبلغ المبيعات</th>
                    <th style="margin-top: 30px">إجمالى المبلغ الصافى</th>
                    <th style="margin-top: 30px">إجمالى خصم الأصناف</th>
                </tr>


                <tr>
                    <td><input type="number" step="any" name="totalt4Amount" onmouseover="findTotalt4Amount()"
                            onkeyup="findTotalt4Amount()" readonly id="totalt4Amount"></td>
                    <td><input type="number" step="any" name="totalt2Amount" onmouseover="findTotalt2Amount()"
                            onkeyup="findTotalt2Amount()" readonly id="totalt2Amount"></td>
                    <td><input type="number" step="any" name="totalDiscountAmount"
                            onmouseover="findTotalDiscountAmount()" onkeyup="findTotalDiscountAmount()" readonly
                            id="totalDiscountAmount"></td>
                    <td><input type="number" step="any" name="TotalSalesAmount" onmouseover="findTotalSalesAmount()"
                            onkeyup="findTotalSalesAmount()" readonly id="TotalSalesAmount"></td>
                    <td><input type="number" step="any" name="TotalNetAmount" onmouseover="findTotalNetAmount()"
                            onkeyup="findTotalNetAmount()" readonly id="TotalNetAmount"></td>
                    <td><input type="number" step="any" name="totalItemsDiscountAmount"
                            onmouseover="findTotalItemsDiscountAmount()" onkeyup="findTotalItemsDiscountAmount()"
                            readonly id="totalItemsDiscountAmount"></td>
                </tr>
                <tr>
                    <th>خصم اضافي</th>
                    <th colspan="2"> المبلغ الإجمالى قبل الخصم </th>
                    <th colspan="3" style="direction: ltr">(المدفوع) المبلغ الإجمالى بعد الخصم </th>
                </tr>

                <tr>
                    <td><input type="number" step="any" name="ExtraDiscount" id="ExtraDiscount"
                            onkeyup="Extradiscount(this.value),findTotalAmount()"
                            onmouseover="Extradiscount(this.value),findTotalAmount()" required></td>
                    </td>
                    <td colspan="2"><input width="40" type="number" step="any" name="totalAmount" readonly
                            id="totalAmount">
                    </td>

                    <td colspan="3"><input width="40" style="color: red;font-weight: bold;font-size: 20px" type="number"
                            step="any" name="totalAmount2" readonly id="totalAmount2">


                    </td>

                </tr>
            </table>
            </tr>

            <div style="text-align: center;margin:50px auto">
                <button type="submit" class="btn btn-success" style="font-size: 30px">إرسال الفاتـــورة</button>
            </div>
    </form>


    @endsection







    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
        let i = 1
        $("#addNewOne").click(function() {
            i++;
            $('#newOne').append(
                `<div id="row${i}">
                    <button type="button" style="margin-right:60px" name="remove" id="${i}"  class="btn btn-danger btn_remove">x</button>
                    {{--  <div class="form-group row invoice-note" style="margin-top: 40px;">
                        <label for="invoice-detail-notes" class="text-center col-sm-12 col-form-label col-form-label-sm" style="text-align: center">وصف
                            المنتج ${i}</label>
                        <div class="col-sm-12" style="margin: 10px">
                            <textarea class="form-control" name="invoiceDescription[]" placeholder="وصف تفصيلى للمنتج ${i}" style="height: 88px;width: 360px;text-align: center;margin:auto"></textarea>
                        </div>
                    </div>  --}}

                    <table style="margin: auto;width: 90%;" border="1">
                        <tr style="margin: 20px;text-align:center">
                            <td colspan="8" style="margin: 20px;text-align:center;margin-right: 50px">
                                <label for="invoice-detail-notes" class="text-center col-sm-12 col-form-label col-form-label-sm"
                                    style="text-align: center">وصف
                                    المنتج ${i}</label>
                                <textarea class="form-control" name="invoiceDescription[]" placeholder="وصف تفصيلى للمنتج ${i}"
                                    style="height: 88px;width: 360px;text-align: center;margin:auto;margin-top: 20px;margin-bottom: 20px"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>قيمة الضريبة  %</th>
                            <th>رمز الصنف</th>
                            <th>قيمة ضريبة المنبع %(t4)</th>
                            <th>الكمـــية</th>
                            <th>المبلغ بالجنيه المصرى</th>
                            <th>الخصـــم</th>
                            <th>خصم الصنف (بعد الضريبة)</th>


                        </tr>
                        <tr>
                            <td>
                               <input type="text" name="rate[]" id="rate${i}" class="form-control form-control-sm">
                               <select name="t1subtype[]" required id="t1subtype" class="form-control form-control-sm form-select mt-2" style="width: 150px">
                                <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة (t1)
                                </option>
                                @foreach ($taxTypes as $type)
                                @if($type->parent === "T1")
                                <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">{{
                                    $type->name_ar }}

                                    @endif
                                    @endforeach
                            </select>
                            </td>
                            <td>
                                <select name="itemCode[]" id="itemCode" class="form-control form-control-sm form-select">

                                    <option disabled selected>اختر النشاط</option>
                               @foreach ($products as $product)
                                <option value="{{ $product['itemCode'] }}" style="font-size: 20px">{{ $product['codeNameSecondaryLang']}}
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" width="1px" name="t4rate[]" id="t4rate${i}" style="margin-bottom:5px">
                                <select name="t4subtype[]" required id="t4subtype" class="form-control form-control-sm form-select" style="width: 150px">
                                    <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة (t4)</option>
                                    @foreach ($taxTypes as $type)
                                    @if($type->parent === "T4")
                                    <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">{{ $type->name_ar }}

                                        @endif
                                        @endforeach
                                </select>
                            </td>
                            <td><input type="number" step="any" name="quantity[]" id="quantity${i}" onkeyup="proccess${i}(this.value),findTotalSalesAmount()" onmouseover="proccess${i}(this.value),findTotalSalesAmount()"></td>
                            <td><input type=number step="any" name="amountEGP[]" id="amountEGP${i}" onkeyup="operation${i}(this.value),findTotalSalesAmount();" onmouseover="operation${i}(this.value),findTotalSalesAmount();"></td>
                            <td><input type="number" step="any" name="discountAmount[]" id="discountAmount${i}" onkeyup="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()" onmouseover="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"></td>

                            <td><input type="number" step="any" name="itemsDiscount[]" id="itemsDiscount${i}" onkeyup="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()" onmouseover="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()">
                        </tr>
                        <tr>
                            <th>قيمة الضريبة (النسبية) </th>
                            <th> قيمة ضريبة (المنبع) </th>
                            <th>إجمالي المبيعات</th>
                            <th>الإجمالى الصافى</th>
                            <th colspan="3"> الإجمالي</th>
                        </tr>
                        <tr>
                            <td> <input type="number" step="any" name="t2Amount[]" readonly id="t2${i}" {{--
                        onkeyup="t2value(this.value)" onmouseover="t2value(this.value)" --}}>
                            </td>
                            <td> <input type="number" step="any" name="t4Amount[]" readonly id="t4Amount${i}">
                            </td>
                            <td><input type=number step="any" name="salesTotal[]" readonly id="salesTotal${i}"></td>
                            <td><input type="number" step="any" readonly name="netTotal[]" id="netTotal${i}" onkeyup="nettotal${i}(this.value),findTotalNetAmount()" onmouseover="nettotal${i}(this.value),findTotalNetAmount()"></td>
                            <td colspan="3"><input type="number" step="any" name="totalItemsDiscount[]" readonly id="totalItemsDiscount${i}">
                        </tr>
                    </table>


                <hr>
                </div> `


            )


            $('<script> function operation' + i + '(value) {var x, y, z;  var quantity = document.getElementById("quantity' + i + '").value; x = value * quantity; document.getElementById("salesTotal' + i + '").value = x.toFixed(5);};  function proccess' + i + '(value) {var x, y, z;  var amounEGP = document.getElementById("amountEGP' + i + '").value; y = value * amounEGP; document.getElementById("salesTotal' + i + '").value = y.toFixed(5);};function discount' + i + '(value) {var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount; salesTotal = document.getElementById("salesTotal' + i + '").value; netTotal = salesTotal - value; netTotalEnd = document.getElementById("netTotal' + i + '").value = netTotal.toFixed(5); rate = document.getElementById("rate' + i + '").value; t4rate = document.getElementById("t4rate' + i + '").value;  t2valueEnd = document.getElementById("t2' + i + '").value = ((netTotalEnd * rate) / 100).toFixed(5); t4Amount = document.getElementById("t4Amount' + i + '").value = ((netTotal * t4rate) / 100).toFixed(5);}; function itemsDiscountValue' + i + '(value) {var x, netTotal, t1amount, t2amount, t4Amount;netTotal = document.getElementById("netTotal' + i + '").value;t2amount = document.getElementById("t2' + i + '").value;t4Amount = document.getElementById("t4Amount' + i + '").value;x = parseFloat(netTotal) + parseFloat(t2amount) - parseFloat(t4Amount) - parseFloat(value);document.getElementById("totalItemsDiscount' + i + '").value = x.toFixed(5);};  </' + 'script>').appendTo('#test123');
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $("#row" + button_id + "").remove()
                findTotalDiscountAmount();
                findTotalSalesAmount();
                findTotalNetAmount();
                findTotalt4Amount();
                findTotalt2Amount();
                findTotalAmount();
                findTotalItemsDiscountAmount();
            })
        });
    });

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




    <script id="test123">
        // this is invoice 1

    function operation(value) {
        var x, y, z;

        var quantity = document.getElementById("quantity").value;
        x = value * quantity;
        document.getElementById("salesTotal").value = x.toFixed(5);
    };

    function proccess(value) {
        var x, y, z;
        var amounEGP = document.getElementById("amountEGP").value;
        y = value * amounEGP;
        document.getElementById("salesTotal").value = y.toFixed(5);
    };

    function discount(value) {
        var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount;
        salesTotal = document.getElementById("salesTotal").value;
        netTotal = salesTotal - value;

        netTotalEnd = document.getElementById("netTotal").value = netTotal.toFixed(5);
        rate = document.getElementById("rate").value;
        t4rate = document.getElementById("t4rate").value;
        t2valueEnd = document.getElementById("t2").value =
            ((netTotalEnd * rate) / 100).toFixed(5);
        t4Amount = document.getElementById("t4Amount").value =
            ((netTotal * t4rate) / 100).toFixed(5);
    }

    function itemsDiscountValue(value) {
        var x, netTotal, t1amount, t2amount, t4Amount;
        netTotal = document.getElementById("netTotal").value;
        t2amount = document.getElementById("t2").value;
        t4Amount = document.getElementById("t4Amount").value;
        x =
            parseFloat(netTotal) +
            parseFloat(t2amount) -
            parseFloat(t4Amount) -
            parseFloat(value);
        document.getElementById("totalItemsDiscount").value = x.toFixed(5);
    }

    function Extradiscount(value) {
        var totalDiscount, x;
        totalDiscount = document.getElementById("totalAmount").value;
        x = totalDiscount - value;
        document.getElementById("totalAmount2").value = x.toFixed(5);
    }

    function findTotalDiscountAmount() {
        var arr = document.getElementsByName("discountAmount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalDiscountAmount").value = tot.toFixed(5);

    }

    function findTotalSalesAmount() {
        var arr = document.getElementsByName("salesTotal[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("TotalSalesAmount").value = tot.toFixed(5);

    }

    function findTotalNetAmount() {
        var arr = document.getElementsByName("netTotal[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("TotalNetAmount").value = tot.toFixed(5);

    }

    function findTotalt4Amount() {
        var arr = document.getElementsByName("t4Amount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalt4Amount").value = tot.toFixed(5);
    }

    function findTotalt2Amount() {
        var arr = document.getElementsByName("t2Amount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalt2Amount").value = tot.toFixed(5);
    }
    function findTotalAmount() {
        var arr = document.getElementsByName("totalItemsDiscount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalAmount").value = tot.toFixed(5);
    }
    function findTotalItemsDiscountAmount() {
        var arr = document.getElementsByName("itemsDiscount[]");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseFloat(arr[i].value)) {
                tot += parseFloat(arr[i].value);
            }
        }
        document.getElementById("totalItemsDiscountAmount").value = tot.toFixed(5);
    }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
