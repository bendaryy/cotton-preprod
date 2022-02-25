@extends('layouts.main')


@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">@lang("site.addInvoice")</div>


            </div>
        </div>
        <!--end breadcrumb-->

        <!--Choose / Add Reciever-->

        <div class="card">
            <div class="card-body p-6">
                <div class="form-body mt-6">
                    <div class="row">
                        @if (request()->routeIs('createInvoice3'))
                            <div class="col-6">
                                <form action="{{ route('createInvoice4') }}" method="GET">
                                    <label for="inputCollection" class="form-label">@lang("site.chooseReceiver")</label>
                                    <select class="single-select" name="receiverName" class="form-control"
                                        id="receiverName">
                                        <option selected disabled>@lang("site.chooseReceiver")</option>
                                        @foreach ($allCompanies as $companies)
                                            <option value="{{ $companies->id }}" class="form-control">
                                                {{ $companies->name }}
                                            </option>
                                        @endforeach


                                    </select>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info"
                                            style="margin-right: 50px;margin-top: 8px;">@lang("site.fillDetails")</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div style="text-align: center">
                                <a href="{{ route('createInvoice3') }}" class="btn btn-success"
                                    style="text-align: center">الرجوع لاختيار
                                    الشركة</a>
                            </div>
                        @endif


                        <div class="col-3">
                            </br><a href="{{ route('customer.create') }}" class="btn btn-info"
                                style="margin-right: 50px;margin-top: 8px;">
                                @lang("site.addReceiver") </a>
                        </div>

                        <form method="POST" action="{{ route('storeInvoice') }}">
                            @method("POST")
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="payment-method-country"
                                        class="form-label">@lang("site.Reciever_type")</label>
                                    <select name="receiverType" class="form-control form-control-sm form-select">
                                        <option value="B" style="font-size: 20px">@lang("site.Company")</option>
                                        <option value="P" style="font-size: 20px">@lang("site.Person")</option>
                                        <option value="F" style="font-size: 20px">@lang("site.Forign")</option>

                                    </select>
                                </div>
                                @if (request()->routeIs('createInvoice3'))
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="recieverName"
                                                class="form-label">@lang("site.Reciever_Name")</label>
                                            <input type="text" class="form-control" name="receiverName"
                                                placeholder="@lang(" site.Reciever_Name")" value="">
                                        </div>
                                    </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="receiverId" class="form-label"
                                style="margin-top:.5rem;">@lang("site.Reciever_Registration_Number_ID")</label>
                            <input type="number" class="form-control" name="receiverId" placeholder="@lang("
                                site.Reciever_Registration_Number_ID")" value="">
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="recieverCountry" class="form-label"
                                    style="margin-top:.5rem;">@lang("site.Country")</label>
                                <input type="text" class="form-control" name="receiverCountry" placeholder="@lang("
                                    site.Country")" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="receiverGovernate" class="form-label"
                                style="margin-top:.5rem;">@lang("site.Governorate")</label>
                            <input type="text" class="form-control" name="receiverGovernate" placeholder="@lang("
                                site.Governorate")" value="">
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="receiverRegionCity" class="form-label"
                                    style="margin-top:.5rem;">@lang("site.City")</label>
                                <input type="text" class="form-control" name="receiverRegionCity" placeholder="@lang("
                                    site.City")" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label for="recieverStreet" class="form-label"
                                style="margin-top:.5rem;">@lang("site.StreetName")</label>
                            <input type="text" class="form-control" name="street" placeholder="@lang(" site.StreetName")"
                                value="">
                        </div>

                        <div class="col-4">
                            <label for="recieverStreet" class="form-label" style="margin-top:.5rem;">رقم المبنى</label>
                            <input type="text" class="form-control" name="receiverBuildingNumber" placeholder="رقم المبنى"
                                value="">
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="receiverPostalCode" class="form-label"
                                    style="margin-top:.5rem;">@lang("site.PostalCode")</label>
                                <input type="number" class="form-control" name="receiverPostalCode" placeholder="@lang("
                                    site.PostalCode")" value="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="receiverFloor" class="form-label"
                            style="margin-top:.5rem;">@lang("site.FloorNo")</label>
                        <input type="text" class="form-control" name="receiverFloor" placeholder="@lang(" site.FloorNo")"
                            value="">
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="receiverRoom" class="form-label"
                                style="margin-top:.5rem;">@lang("site.FlatNo")</label>
                            <input type="number" class="form-control" name="receiverRoom" placeholder="@lang("
                                site.FlatNo")" value="">
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="receiverLandmark" class="form-label"
                                style="margin-top:.5rem;">@lang("site.landmark")</label>
                            <input type="text" class="form-control" name="receiverLandmark" placeholder="@lang("
                                site.landmark")" value="">
                        </div>

                        <div class="col-6">
                            <div class="form-group row">
                                <label for="receiverAdditionalInformation" class="form-label"
                                    style="margin-top:.5rem;">@lang("site.AdditionalInformation")</label>
                                <input type="number" class="form-control" name="receiverAdditionalInformation"
                                    placeholder="@lang(" site.AdditionalInformation")" value="">
                            </div>
                        </div>
                    </div>

                </div>
            @else
                @foreach ($companiess as $com)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="recieverName" class="form-label">@lang("site.Reciever_Name")</label>
                            <input type="text" class="form-control" name="receiverName" placeholder="@lang("
                                site.Reciever_Name")" value="{{ $com->name }}">
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="receiverId" class="form-label"
                    style="margin-top:.5rem;">@lang("site.Reciever_Registration_Number_ID")</label>
                <input type="number" class="form-control" name="receiverId" placeholder="@lang("
                    site.Reciever_Registration_Number_ID")" value="{{ $com->tax_id }}">
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="recieverCountry" class="form-label"
                        style="margin-top:.5rem;">@lang("site.Country")</label>
                    <input type="text" class="form-control" name="receiverCountry" placeholder="@lang(" site.Country")"
                        value="{{ $com->country }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="receiverGovernate" class="form-label"
                    style="margin-top:.5rem;">@lang("site.Governorate")</label>
                <input type="text" class="form-control" name="receiverGovernate" placeholder="@lang(" site.Governorate")"
                    value="{{ $com->governate }}">
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="receiverRegionCity" class="form-label"
                        style="margin-top:.5rem;">@lang("site.City")</label>
                    <input type="text" class="form-control" name="receiverRegionCity" placeholder="@lang(" site.City")"
                        value="{{ $com->regionCity }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <label for="recieverStreet" class="form-label"
                    style="margin-top:.5rem;">@lang("site.StreetName")</label>
                <input type="text" class="form-control" name="street" placeholder="@lang(" site.StreetName")"
                    value="{{ $com->street }}">
            </div>

            <div class="col-4">
                <label for="recieverStreet" class="form-label" style="margin-top:.5rem;">رقم المبنى</label>
                <input type="text" class="form-control" name="receiverBuildingNumber"
                    value="{{ $com->buildingNumber }}" placeholder="رقم المبنى" value="">
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="receiverPostalCode" class="form-label"
                        style="margin-top:.5rem;">@lang("site.PostalCode")</label>
                    <input type="number" class="form-control" name="receiverPostalCode" placeholder="@lang("
                        site.PostalCode")" value="{{ $com->postalCode }}">
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-6">
            <label for="receiverFloor" class="form-label" style="margin-top:.5rem;">@lang("site.FloorNo")</label>
            <input type="text" class="form-control" name="receiverFloor" placeholder="@lang(" site.FloorNo")"
                value="{{ $com->floor }}">
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="receiverRoom" class="form-label" style="margin-top:.5rem;">@lang("site.FlatNo")</label>
                <input type="text" class="form-control" name="receiverRoom" placeholder="@lang(" site.FlatNo")"
                    value="{{ $com->room }}">
            </div>


        </div>
        <div class="row">
            <div class="col-6">
                <label for="receiverLandmark" class="form-label"
                    style="margin-top:.5rem;">@lang("site.landmark")</label>
                <input type="text" class="form-control" name="receiverLandmark" placeholder="@lang(" site.landmark")"
                    value="{{ $com->landmark }}">
            </div>

            <div class="col-6">
                <div class="form-group row">
                    <label for="receiverAdditionalInformation" class="form-label"
                        style="margin-top:.5rem;">@lang("site.AdditionalInformation")</label>
                    <input type="text" class="form-control" name="receiverAdditionalInformation" placeholder="@lang("
                        site.AdditionalInformation")" value="{{ $com->additionalInformation }}">
                </div>
            </div>
        </div>

    </div>
    @endforeach
    @endif

    <hr>




    <div class="row">
        <div class="col-6">
            <label for="payment-method-country" class="form-label" style="margin-bottom: 5px; ">
                @lang("site.Tax Activity Code")</label>
            <select name="taxpayerActivityCode" class="form-select">
                @foreach ($ActivityCodes as $code)
                    <option value="{{ $code->code }}"> {{ $code->Desc_ar }} </option>
                @endforeach
            </select>
        </div>



        <div class="col-6">
            <label for="payment-method-country" class="form-label">@lang("site.Document Type")</label>
            <select name="DocumentType" class="form-control form-control-sm form-select">
                <option value="I" selected>فاتورة</option>
                <option value="C">إشعار دائن</option>
                <option value="D">إشعار مدين</option>
            </select>
        </div>

        <div class="row">
            <div class="col-6">
                <label class="form-label">@lang("site.Internal ID")</label>

                <input type="text" class="form-control form-control-sm text-center" style="float: left; " id="internalId"
                    name="internalId" placeholder="@lang(" site.Internal ID")">

                <button onClick="randomTest();" class="btn btn-sm btn-outline-secondary"
                    type="button">@lang("site.Generate")</button>

            </div>


            <div class="col-6">
                <label class="form-label" style="margin-top: 5px;"> @lang("site.Document Date")</label>

                <input type="date" value="{{ date(' Y-m-d') }}" class="form-control form-control-sm text-center"
                    name="date" placeholder="">

            </div>

        </div>

        <!--end page wrapper -->
        <div class="accordion" id="accordionExample" style="padding-top: 20px;">

            <div class="accordion-item">
                <h2 class="accordion-header" id="bankDetails">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">@lang("site.bank") </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="bankDetails"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">


                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">@lang("site.Bank Name")</label>
                                <input type="text" class="form-control form-control-sm text-center" name="bankName"
                                    placeholder="  @lang(" site.Bank Name")">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">@lang("site.Bank Address")</label>
                                <input type="text" class="form-control form-control-sm text-center" name="bankAddress"
                                    placeholder="  @lang(" site.Bank Address")">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"> @lang("site.Bank Account No")</label>
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="bankAccountNo" placeholder="  @lang(" site.Bank Account No")">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"> @lang("site.Bank Account IBAN")</label>
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="bankAccountIBAN" placeholder=" @lang(" site.Bank Account IBAN")">

                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label"> @lang("site.Swift Code")</label>
                                        <input type="text" class="form-control form-control-sm text-center"
                                            name="swiftCode" placeholder="  @lang(" site.Swift Code")">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label"> @lang("site.Payment Terms")</label>
                                        <input type="text" class="form-control form-control-sm text-center"
                                            name="Bankterms" placeholder="  @lang(" site.Payment Terms")">

                                    </div>



                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="form-body mt-4">
        <div class="row">
            <div class="col-lg-8">

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="lineDetails">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                @lang("site.Line Items")</button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="lineDetails"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="newOne">

                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">@lang("site.Line
                                            Items")</label>

                                        <select name="itemCode[]" id="itemCode" class="form-control form-control-sm">
                                            <option value="10000335" selected>المنتجات الصوفية القطنية</option>
                                            <option value="10000742">تشطيب/تنشية الأقمشة</option>
                                            <option value="10000715">مجموعات متنوعة من مستحضرات النظافة العامة والشخصية
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">@lang("site.Line
                                            Decription")</label>
                                        <textarea name="invoiceDescription[]" class="form-control"
                                            id="inputProductDescription" rows="2"></textarea>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="linePrice" class="form-label">Price</label>
                                            <input class="form-control" step="any" type="number" step="any"
                                                name="amountEGP[]" id="amountEGP"
                                                onkeyup="operation(this.value),findTotalSalesAmount();;"
                                                onmouseover="operation(this.value),findTotalSalesAmount();;">
                                        </div>
                                        <div class=" col-md-6">
                                            <label class="form-label">Quantity</label>
                                            <input class="form-control" type="number" step="any" name="quantity[]"
                                                id="quantity" onkeyup="proccess(this.value),findTotalSalesAmount();"
                                                onmouseover="proccess(this.value),findTotalSalesAmount();">
                                        </div>
                                    </div>
                                    <div class=" row g-3">
                                        <div class="col-md-6">
                                            <label for="inputProductTitle" class="form-label">@lang("site.Tax
                                                added Type")</label>

                                            <select name="t1subtype[]" required id="t1subtype"
                                                class="form-control form-control-sm form-select">
                                                <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة
                                                </option>
                                                @foreach ($taxTypes as $type)
                                                    @if ($type->parent === 'T1')
                                                        <option value="{{ $type->code }}"
                                                            style="font-size: 15px;width: 100px;">
                                                            {{ $type->name_ar }}
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lineTaxAdd" class="form-label">@lang("site.Tax_added")</label>
                                            <input type="number" class="form-control" name="rate[]" id="rate"
                                                class="form-control form-control-sm" onkeyup="findTotalt2Amount()"
                                                onmouseover="findTotalt2Amount()" placeholder="@lang(" site.Tax_added")">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputProductTitle" class="form-label">@lang("site.Tax t4
                                                Type")</label>
                                            <select name="t4subtype[]" required id="t4subtype"
                                                class="form-control form-control-sm form-select">
                                                <option disabled selected>@lang("site.Tax t4 Type")</option>
                                                @foreach ($taxTypes as $type)
                                                    @if ($type->parent === 'T4')
                                                        <option value="{{ $type->code }}"
                                                            style="font-size: 15px;width: 100px;">
                                                            {{ $type->name_ar }}
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lineTaxT4" class="form-label">@lang("site.Tax t4
                                                Value")</label>
                                            <input type="number" class="form-control" name="t4rate[]" id="t4rate"
                                                onkeyup="findTotalt4Amount()" onmouseover="findTotalt4Amount()"
                                                placeholder="@lang(" site.Tax t4 Value")">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="lineDiscount" class="form-label">@lang("site.Discount")</label>

                                            <input class="form-control" placeholder=" @lang(" site.Discount")"
                                                type="number" step="any" name="discountAmount[]" id="discountAmount"
                                                onkeyup="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"
                                                onmouseover="discount(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lineDiscountAfterTax"
                                                class="form-label">@lang("site.Discount_After_Tax") </label>
                                            <input type="number" class="form-control" step="any" name="itemsDiscount[]"
                                                id="itemsDiscount"
                                                onkeyup="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                                                onmouseover="itemsDiscountValue(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                                                placeholder="@lang(" site.Discount_After_Tax")">
                                        </div>
                                    </div>
                                </div></BR>
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        @lang("site.Line Total")
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="TotalTaxableFees" class="form-label">@lang("site.Total
                                                    Taxable
                                                    Fees")</label>
                                                <input type="number" readonly class="form-control" step="any"
                                                    name="t2Amount[]" id="t2" onkeyup="findTotalt2Amount()"
                                                    onmouseover="findTotalt2Amount()" placeholder="@lang(" site.Total
                                                    Taxable Fees")">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Totalt4Amount"
                                                    class="form-label">@lang("site.Totalt4Amount")</label>
                                                <input type="number" class="form-control" name="t4Amount[]" readonly
                                                    id="t4Amount" onkeyup="findTotalt4Amount()"
                                                    onmouseover="findTotalt4Amount()" placeholder="@lang("
                                                    site.Totalt4Amount")">
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="Subtotal" class="form-label">@lang("site.Sub
                                                    total")</label>
                                                <input type="number" class="form-control" name="salesTotal[]" readonly
                                                    id="salesTotal" placeholder="@lang(" site.Sub total")">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="NetTotal" class="form-label">@lang("site.Net
                                                    Total")</label>
                                                <input type="number" class="form-control" readonly name="netTotal[]"
                                                    id="netTotal" onkeyup="nettotal(this.value),findTotalNetAmount()"
                                                    onmouseover="nettotal(this.value),findTotalNetAmount()"
                                                    placeholder="@lang(" site.Net Total")">
                                            </div>
                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-12">
                                                <label for="lineTotal"
                                                    class="form-label">@lang("site.lineTotal")</label>
                                                <input type="number" class="form-control" name="totalItemsDiscount[]"
                                                    readonly id="totalItemsDiscount" onkeyup="findTotalAmount()"
                                                    onmouseover="findTotalAmount()" placeholder="@lang(" site.lineTotal")">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div style="z-index:1;text-align: center">
                                <button id="addNewOne" type="button" class="btn btn-info" style="width: 200px">Add
                                    Line</button>

                            </div>
                        </div>
                    </div>


                </div>
            </div>







            <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="findTotalt2Amount" class="form-label">@lang("site.Total T2
                                Amount")</label>
                            <input type="number" class="form-control" step="any" name="totalt2Amount"
                                onmouseover="findTotalt2Amount()" onkeyup="findTotalt2Amount()" readonly id="totalt2Amount">
                        </div>
                        <div class="col-md-6">
                            <label for="findTotalt4Amount" class="form-label">@lang("site.Total T4
                                Amount")</label>
                            <<input class="form-control" type="number" step="any" name="totalt4Amount"
                                onmouseover="findTotalt4Amount()" onkeyup="findTotalt4Amount()" readonly id="totalt4Amount">
                        </div>
                        <div class="col-md-6">
                            <label for="salesTotal" class="form-label">@lang("site.Sales Total")</label>
                            <input type="number" class="form-control" name="totalDiscountAmount"
                                onmouseover="findTotalDiscountAmount()" onkeyup="findTotalDiscountAmount()" readonly
                                id="totalDiscountAmount">
                        </div>
                        <div class="col-md-6">
                            <label for="netTotal" class="form-label">@lang("site.Net Total")</label>
                            <input type="number" class="form-control" step="any" name="TotalSalesAmount"
                                onmouseover="findTotalSalesAmount()" onkeyup="findTotalSalesAmount()" readonly
                                id="TotalSalesAmount">
                        </div>
                        <div class="col-md-6">
                            <label for="findTotalNetAmount" class="form-label">@lang("site.Total Net
                                Amount")</label>
                            <input type="number" step="any" class="form-control" name="TotalNetAmount"
                                onmouseover="findTotalNetAmount()" onkeyup="findTotalNetAmount()" readonly
                                id="TotalNetAmount">
                        </div>
                        <div class="col-md-6">
                            <label for="TotalDiscount" class="form-label">@lang("site.Total Discount")</label>
                            <input type="number" step="any" name="totalItemsDiscountAmount" class="form-control"
                                onmouseover="findTotalItemsDiscountAmount()" onkeyup="findTotalItemsDiscountAmount()"
                                readonly id="totalItemsDiscountAmount">
                        </div>


                        <div class="col-12">
                            <label for="ExtraInvoiceDiscount" class="form-label">@lang("site.Extra Invoice
                                Discount") </label>
                            <input type="number" class="form-control" step="any" name="ExtraDiscount" id="ExtraDiscount"
                                onkeyup="Extradiscount(this.value),findTotalAmount()"
                                onmouseover="Extradiscount(this.value),findTotalAmount()" required>
                        </div>


                        <div class="col-12">
                            <label for="findTotalAmount" class="form-label">إجمالى المبلغ (قبل الخصم)
                            </label>
                            <input class="form-control" type="number" step="any" name="totalAmount" readonly
                                id="totalAmount">
                        </div>


                        <div class="col-12">
                            <label for="findTotalAmount" class="form-label">إجمالى المبلغ (بعد الخصم)
                            </label>
                            <input type="number" class="form-control"
                                style="color: red;font-weight: bold;font-size: 20px" type="number" step="any"
                                name="totalAmount2" readonly id="totalAmount2">
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit Document</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>


    <script>
        $(document).ready(function() {
            let i = 1
            $("#addNewOne").click(function() {
                i++;
                $('#newOne').append(
                    `<div id="row${i}">
                                <button type="button" style="margin-right:30px" name="remove" id="${i}"  class="btn btn-danger btn_remove">x</button>


                               <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">@lang("site.Line
                                        Items")</label>

                                    <select name="itemCode[]" id="itemCode" class="form-control form-control-sm">
                            <option value="10000335" selected>المنتجات الصوفية القطنية</option>
                            <option value="10000742">تشطيب/تنشية الأقمشة</option>
                            <option value="10000715">مجموعات متنوعة من مستحضرات النظافة العامة والشخصية</option>
                                     </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">@lang("site.Line
                                        Decription") ${i}</label>
                                    <textarea name="invoiceDescription[]" class="form-control" id="inputProductDescription" rows="2"></textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="linePrice" class="form-label">Price</label>
                                        <input class="form-control" step="any" type="number" step="any" name="amountEGP[]" id="amountEGP${i}"
                                            onkeyup="operation${i}(this.value),findTotalSalesAmount();;"
                                            onmouseover="operation${i}(this.value),findTotalSalesAmount();;">
                                    </div>
                                    <div class=" col-md-6">
                                        <label class="form-label">Quantity</label>
                                        <input class="form-control" type="number" step="any" name="quantity[]" id="quantity${i}"
                                            onkeyup="proccess${i}(this.value),findTotalSalesAmount();"
                                            onmouseover="proccess${i}(this.value),findTotalSalesAmount();">
                                    </div>
                                </div>
                                <div class=" row g-3">
                                    <div class="col-md-6">
                                        <label for="inputProductTitle" class="form-label">@lang("site.Tax
                                            added Type")</label>

                                        <select name="t1subtype[]" required id="t1subtype" class="form-control form-control-sm form-select">
                                            <option disabled selected style="font-size: 15px;width: 100px;">نوع الضريبة
                                            </option>
                                            @foreach ($taxTypes as $type)
                                                @if ($type->parent === 'T1')
                                                    <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">
                                                        {{ $type->name_ar }}
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lineTaxAdd" class="form-label">@lang("site.Tax_added")</label>
                                        <input type="number" class="form-control" name="rate[]" id="rate${i}" class="form-control form-control-sm"
                                            onkeyup="findTotalt2Amount()" onmouseover="findTotalt2Amount()" placeholder="@lang(" site.Tax_added")">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputProductTitle" class="form-label">@lang("site.Tax t4
                                            Type")</label>
                                        <select name="t4subtype[]" required id="t4subtype" class="form-control form-control-sm form-select">
                                            <option disabled selected>@lang("site.Tax t4 Type")</option>
                                            @foreach ($taxTypes as $type)
                                                @if ($type->parent === 'T4')
                                                    <option value="{{ $type->code }}" style="font-size: 15px;width: 100px;">
                                                        {{ $type->name_ar }}
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lineTaxT4" class="form-label">@lang("site.Tax t4
                                            Value")</label>
                                        <input type="number" class="form-control" name="t4rate[]" id="t4rate${i}" onkeyup="findTotalt4Amount()"
                                            onmouseover="findTotalt4Amount()" placeholder="@lang(" site.Tax t4 Value")">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="lineDiscount" class="form-label">@lang("site.Discount")</label>

                                        <input class="form-control" placeholder=" @lang(" site.Discount")" type="number" step="any"
                                            name="discountAmount[]" id="discountAmount${i}"
                                            onkeyup="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()"
                                            onmouseover="discount${i}(this.value),findTotalDiscountAmount(),findTotalNetAmount(),findTotalt4Amount(),findTotalt2Amount()">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lineDiscountAfterTax" class="form-label">@lang("site.Discount_After_Tax") </label>
                                        <input type="number" class="form-control" step="any" name="itemsDiscount[]" id="itemsDiscount${i}"
                                            onkeyup="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                                            onmouseover="itemsDiscountValue${i}(this.value),findTotalAmount(),findTotalItemsDiscountAmount()"
                                            placeholder="@lang(" site.Discount_After_Tax")">
                                    </div>
                                </div>
                            </div></BR>
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3">
                                    @lang("site.Line Total")
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="TotalTaxableFees" class="form-label">@lang("site.Total
                                                Taxable
                                                Fees")</label>
                                            <input type="number" readonly class="form-control" step="any" name="t2Amount[]" id="t2${i}"
                                                onkeyup="findTotalt2Amount()" onmouseover="findTotalt2Amount()" placeholder="@lang(" site.Total
                                                Taxable Fees")">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Totalt4Amount" class="form-label">@lang("site.Totalt4Amount")</label>
                                            <input type="number" class="form-control" name="t4Amount[]" readonly id="t4Amount${i}"
                                                onkeyup="findTotalt4Amount()" onmouseover="findTotalt4Amount()" placeholder="@lang("
                                                site.Totalt4Amount")">
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="Subtotal" class="form-label">@lang("site.Sub
                                                total")</label>
                                            <input type="number" class="form-control" name="salesTotal[]" readonly id="salesTotal${i}"
                                                placeholder="@lang(" site.Sub total")">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="NetTotal" class="form-label">@lang("site.Net
                                                Total")</label>
                                            <input type="number" class="form-control" readonly name="netTotal[]" id="netTotal${i}"
                                                onkeyup="nettotal${i}(this.value),findTotalNetAmount()"
                                                onmouseover="nettotal${i}(this.value),findTotalNetAmount()" placeholder="@lang(" site.Net Total")">
                                        </div>
                                    </div>
                                    <div class="row g-3">

                                        <div class="col-md-12">
                                            <label for="lineTotal" class="form-label">@lang("site.lineTotal")</label>
                                            <input type="number" class="form-control" name="totalItemsDiscount[]" readonly id="totalItemsDiscount${i}"
                                                onkeyup="findTotalAmount()" onmouseover="findTotalAmount()" placeholder="@lang(" site.lineTotal")">
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <hr>
                        </div> `)


                $('<script> function operation' + i +
                    '(value) {var x, y, z;  var quantity = document.getElementById("quantity' + i +
                    '").value; x = value * quantity; document.getElementById("salesTotal' + i +
                    '").value = x.toFixed(2);};  function proccess' + i +
                    '(value) {var x, y, z;  var amounEGP = document.getElementById("amountEGP' + i +
                    '").value; y = value * amounEGP; document.getElementById("salesTotal' + i +
                    '").value = y.toFixed(2);};function discount' + i +
                    '(value) {var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount; salesTotal = document.getElementById("salesTotal' +
                    i +
                    '").value; netTotal = salesTotal - value; netTotalEnd = document.getElementById("netTotal' +
                    i + '").value = netTotal.toFixed(2); rate = document.getElementById("rate' + i +
                    '").value; t4rate = document.getElementById("t4rate' + i +
                    '").value;  t2valueEnd = document.getElementById("t2' + i +
                    '").value = ((netTotalEnd * rate) / 100).toFixed(2); t4Amount = document.getElementById("t4Amount' +
                    i +
                    '").value = ((netTotal * t4rate) / 100).toFixed(2);}; function itemsDiscountValue' +
                    i +
                    '(value) {var x, netTotal, t1amount, t2amount, t4Amount;netTotal = document.getElementById("netTotal' +
                    i + '").value;t2amount = document.getElementById("t2' + i +
                    '").value;t4Amount = document.getElementById("t4Amount' + i +
                    '").value;x = parseFloat(netTotal) + parseFloat(t2amount) - parseFloat(t4Amount) - parseFloat(value);document.getElementById("totalItemsDiscount' +
                    i + '").value = x.toFixed(2);};  </' + 'script>').appendTo('#test123');
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
            document.getElementById("salesTotal").value = x.toFixed(2);
        };

        function proccess(value) {
            var x, y, z;
            var amounEGP = document.getElementById("amountEGP").value;
            y = value * amounEGP;
            document.getElementById("salesTotal").value = y.toFixed(2);
        };

        function discount(value) {
            var salesTotal, netTotal, z, t2valueEnd, t1Value, rate, t4rate, t4Amount;
            salesTotal = document.getElementById("salesTotal").value;
            netTotal = salesTotal - value;

            netTotalEnd = document.getElementById("netTotal").value = netTotal.toFixed(2);
            rate = document.getElementById("rate").value;
            t4rate = document.getElementById("t4rate").value;
            t2valueEnd = document.getElementById("t2").value =
                ((netTotalEnd * rate) / 100).toFixed(2);
            t4Amount = document.getElementById("t4Amount").value =
                ((netTotal * t4rate) / 100).toFixed(2);
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
            document.getElementById("totalItemsDiscount").value = x.toFixed(2);
        }

        function Extradiscount(value) {
            var totalDiscount, x;
            totalDiscount = document.getElementById("totalAmount").value;
            x = totalDiscount - value;
            document.getElementById("totalAmount2").value = x.toFixed(2);
        }

        function findTotalDiscountAmount() {
            var arr = document.getElementsByName("discountAmount[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("totalDiscountAmount").value = tot.toFixed(2);

        }

        function findTotalSalesAmount() {
            var arr = document.getElementsByName("salesTotal[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("TotalSalesAmount").value = tot.toFixed(2);

        }

        function findTotalNetAmount() {
            var arr = document.getElementsByName("netTotal[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("TotalNetAmount").value = tot.toFixed(2);

        }

        function findTotalt4Amount() {
            var arr = document.getElementsByName("t4Amount[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("totalt4Amount").value = tot.toFixed(2);
        }

        function findTotalt2Amount() {
            var arr = document.getElementsByName("t2Amount[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("totalt2Amount").value = tot.toFixed(2);
        }

        function findTotalAmount() {
            var arr = document.getElementsByName("totalItemsDiscount[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("totalAmount").value = tot.toFixed(2);
        }

        function findTotalItemsDiscountAmount() {
            var arr = document.getElementsByName("itemsDiscount[]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    tot += parseFloat(arr[i].value);
                }
            }
            document.getElementById("totalItemsDiscountAmount").value = tot.toFixed(2);
        }
    </script>
    <!--end row-->
    <script>
        function randomTest() {
            var internalValue = document.getElementById('internalId');
            internalValue.value = Math.floor(Math.random() * 105140);
        }
    </script>
