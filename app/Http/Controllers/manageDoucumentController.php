<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class manageDoucumentController extends Controller
{

    // this is for show sent inovices
    public function sentInvoices()
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');

        $allInvoices = $showInvoices['result'];

        $allMeta = $showInvoices['metadata'];
        $taxId = auth()->user()->details->company_id;

        return view('invoices.sentInvoices', compact('allInvoices', 'allMeta', 'taxId'));
    }

    // this is for show recieved inovices

    public function receivedInvoices()
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $showInvoices = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/recent?pageSize=2000000000');

        $allInvoices = $showInvoices['result'];

        $allMeta = $showInvoices['metadata'];
        $taxId = auth()->user()->details->company_id;

        return view('invoices.receivedInvoices', compact('allInvoices', 'allMeta', 'taxId'));
    }

// this function for create invoice

    // public function invoice(Request $request)
    // {

    //     $invoice =
    //         [
    //         "issuer" => array(
    //             "address" => array(
    //                 "branchID" => "0",
    //                 "country" => "EG",
    //                 "governate" => auth()->user()->details->governate,
    //                 "regionCity" => auth()->user()->details->regionCity,
    //                 "street" => auth()->user()->details->street,
    //                 "buildingNumber" => auth()->user()->details->buildingNumber,
    //             ),
    //             "type" => auth()->user()->details->issuerType,
    //             "id" => auth()->user()->details->company_id,
    //             "name" => auth()->user()->details->company_name,
    //         ),
    //         "receiver" => array(
    //             "address" => array(
    //                 "country" => $request->receiverCountry,
    //                 "governate" => $request->receiverGovernate,
    //                 "regionCity" => $request->receiverRegionCity,
    //                 "street" => $request->street,
    //                 "buildingNumber" => $request->receiverBuildingNumber,
    //                 "postalCode" => $request->receiverPostalCode,
    //                 "floor" => $request->receiverFloor,
    //                 "room" => $request->receiverRoom,
    //                 "landmark" => $request->receiverLandmark,
    //                 "additionalInformation" => $request->receiverAdditionalInformation,
    //             ),
    //             "type" => $request->receiverType,
    //             "id" => $request->receiverId,
    //             "name" => $request->receiverName,

    //         ),
    //         "payment" => array(
    //             "bankName" => $request->bankName,
    //             "bankAddress" => $request->bankAddress,
    //             "bankAccountNo" => $request->bankAccountNo,
    //             "bankAccountIBAN" => $request->bankAccountIBAN,
    //             "swiftCode" => $request->swiftCode,
    //             "terms" => $request->Bankterms,
    //         ),
    //         "documentType" => $request->DocumentType,
    //         "documentTypeVersion" => "0.9",
    //         "dateTimeIssued" => $request->date . "T" . date("h:i:s") . "Z",
    //         "taxpayerActivityCode" => $request->taxpayerActivityCode,
    //         "internalID" => $request->internalId,
    //         "invoiceLines" => [

    //         ],
    //         "totalDiscountAmount" => floatval($request->totalDiscountAmount),
    //         "totalSalesAmount" => floatval($request->TotalSalesAmount),
    //         "netAmount" => floatval($request->TotalNetAmount),
    //         "taxTotals" => array(
    //             array(
    //                 "taxType" => "T4",
    //                 "amount" => floatval($request->totalt4Amount),
    //             ),
    //             array(
    //                 "taxType" => "T1",
    //                 "amount" => floatval($request->totalt2Amount),
    //             ),
    //         ),
    //         "totalAmount" => floatval($request->totalAmount2),
    //         "extraDiscountAmount" => floatval($request->ExtraDiscount),
    //         "totalItemsDiscountAmount" => floatval($request->totalItemsDiscountAmount),
    //     ];

    //     for ($i = 0; $i < count($request->quantity); $i++) {
    //         $Data = [
    //             "description" => $request->invoiceDescription[$i],
    //             "itemType" => "EGS",
    //             "itemCode" => $request->itemCode[$i],
    //             // "itemCode" => "10003834",
    //             "unitType" => "EA",
    //             "quantity" => floatval($request->quantity[$i]),
    //             "internalCode" => "100",
    //             "salesTotal" => floatval($request->salesTotal[$i]),
    //             "total" => floatval($request->totalItemsDiscount[$i]),
    //             "valueDifference" => 0.00,
    //             "totalTaxableFees" => 0.00,
    //             "netTotal" => floatval($request->netTotal[$i]),
    //             "itemsDiscount" => floatval($request->itemsDiscount[$i]),

    //             "unitValue" => [
    //                 "currencySold" => "EGP",
    //                 "amountSold" => 0.00,
    //                 "currencyExchangeRate" => 0.00,
    //                 "amountEGP" => floatval($request->amountEGP[$i]),
    //             ],
    //             "discount" => [
    //                 "rate" => 0.00,
    //                 "amount" => floatval($request->discountAmount[$i]),
    //             ],
    //             "taxableItems" => [
    //                 [

    //                     "taxType" => "T4",
    //                     "amount" => floatval($request->t4Amount[$i]),
    //                     "subType" => ($request->t4subtype[$i]),
    //                     "rate" => floatval($request->t4rate[$i]),
    //                 ],
    //                 [
    //                     "taxType" => "T1",
    //                     "amount" => floatval($request->t2Amount[$i]),
    //                     "subType" => ($request->t1subtype[$i]),
    //                     "rate" => floatval($request->rate[$i]),
    //                 ],
    //             ],

    //         ];
    //         $invoice['invoiceLines'][$i] = $Data;
    //     }

    //     $trnsformed = json_encode($invoice, JSON_UNESCAPED_UNICODE);
    //     $myFileToJson = fopen("storage/EInvoicing/SourceDocumentJson.json", "w") or die("unable to open file");
    //     fwrite($myFileToJson, $trnsformed);
    //     return redirect()->route('cer');

    // }

    public function invoice(Request $request)
    {

        // $invoice =

        // '
        //         {
        //             "doucuments":[
        //                 {
        //                     "issuer":{
        //                         "address":{
        //                              "branchID" : ' . "0" . ',
        //                              "country" : ' . "EG" . ',
        //                              "governate" : ' . auth()->user()->details->governate . ',
        //                              "regionCity" :' . auth()->user()->details->regionCity . ',
        //                              "street" : ' . auth()->user()->details->street . '",
        //                              "buildingNumber" : ' . auth()->user()->details->buildingNumber . ',
        //                         },
        //                              "type": ' . auth()->user()->details->issuerType . ',
        //                              "id": ' . auth()->user()->details->company_id . ',
        //                              "name": ' . auth()->user()->details->company_name . ',
        //                     },
        //                      "receiver": {
        //                       "address": {
        //                           "country": ' . $request->receiverCountry . ',
        //                           "governate": ' . $request->receiverGovernate . ',
        //                           "regionCity": ' . $request->receiverRegionCity . ',
        //                           "street": ' . $request->street . ',
        //                           "buildingNumber": ' . $request->receiverBuildingNumber . ',
        //                           "postalCode": ' . $request->receiverPostalCode . ',
        //                           "floor":' . $request->receiverFloor . ',
        //                           "room": ' . $request->receiverRoom . ',
        //                           "landmark": ' . $request->receiverLandmark . ',
        //                           "additionalInformation": ' . $request->receiverAdditionalInformation . '
        //                       },
        //                       "type":  ' . $request->receiverType . ',
        //                       "id": ' . $request->receiverId . ',
        //                       "name": ' . $request->receiverName . ',
        //                   },
        //                    "documentType": ' . $request->DocumentType . ',
        //                    "documentTypeVersion": "0.9",
        //                    "dateTimeIssued": ' . $request->date . "T" . date("h:i:s") . "Z" . ',
        //                    "taxpayerActivityCode": ' . $request->taxpayerActivityCode . ',
        //                    "internalID": ' . $request->internalId . ',
        //                    "payment": {
        //                          "bankName": ' . $request->bankName . ',
        //                          "bankAddress": ' . $request->bankAddress . ',
        //                          "bankAccountNo": ' . $request->bankAccountNo . ',
        //                          "bankAccountIBAN": ' . $request->bankAccountIBAN . ',
        //                          "swiftCode": ' . $request->swiftCode . ',
        //                          "terms": ' . $request->Bankterms . ',
        //                     },
        //                      "invoiceLines" => [

        //                     ],
        //                     "totalDiscountAmount" : ' . floatval($request->totalDiscountAmount) . ',
        //                     "totalSalesAmount" : ' . floatval($request->TotalSalesAmount) . ',
        //                     "netAmount" : ' . floatval($request->TotalNetAmount) . ',
        //                      "taxTotals": [
        //                             {
        //                                 "taxType": "T4",
        //                                 "amount": ' . floatval($request->totalt4Amount) . '
        //                             }
        //                             {
        //                                 "taxType": "T1",
        //                                 "amount": ' . floatval($request->totalt2Amount) . '
        //                             }
        //                       ],
        //                        "totalAmount": ' . floatval($request->totalAmount2) . ',
        //                        "extraDiscountAmount": ' . floatval($request->ExtraDiscount) . ',
        //                        "totalItemsDiscountAmount": ' . floatval($request->totalItemsDiscountAmount) . ',
        //                         "signatures": [
        //                             {
        //                                 "signatureType": "I",
        //                                 "value":  ""
        //                             }
        //                         ]
        //                 }

        //             ]

        //         }';

        $validated = $request->validate([
            // 'receiverCountry' => 'required',
            // 'receiverCountry' => 'required',
            // 'receiverGovernate' => 'required',
            // 'receiverRegionCity' => 'required',
            'receiverType' => 'required',
            // 'receiverId' => 'required',
            // 'receiverName' => 'required',
            'DocumentType' => 'required',
            'date' => 'required',
            'taxpayerActivityCode' => 'required',
            'internalId' => 'required',
            'ExtraDiscount' => 'required',
            'rate' => 'required',
            'invoiceDescription' => 'required',
            'itemCode' => 'required',
            't4subtype' => 'required',
            't1subtype' => 'required',

        ]);

        $invoice =
            [
            "issuer" => array(
                "address" => array(
                    "branchID" => "0",
                    "country" => "EG",
                    "governate" => auth()->user()->details->governate,

                    "regionCity" => auth()->user()->details->regionCity,
                    "street" => auth()->user()->details->street,
                    "buildingNumber" => auth()->user()->details->buildingNumber,
                ),
                "type" => auth()->user()->details->issuerType,
                "id" => auth()->user()->details->company_id,
                "name" => auth()->user()->details->company_name,
            ),
            "payment" => array(
                "bankName" => $request->bankName,
                "bankAddress" => $request->bankAddress,
                "bankAccountNo" => $request->bankAccountNo,
                "bankAccountIBAN" => $request->bankAccountIBAN,
                "swiftCode" => $request->swiftCode,
                "terms" => $request->Bankterms,
            ),
            "receiver" => array(
                "address" => array(
                    "country" => $request->receiverCountry,
                    "governate" => $request->receiverGovernate,
                    "regionCity" => $request->receiverRegionCity,
                    "street" => $request->street,
                    "buildingNumber" => $request->receiverBuildingNumber,
                    "postalCode" => $request->receiverPostalCode,
                    "floor" => $request->receiverFloor,
                    "room" => $request->receiverRoom,
                    "landmark" => $request->receiverLandmark,
                    "additionalInformation" => $request->receiverAdditionalInformation,
                ),
                "type" => $request->receiverType,
                "id" => $request->receiverId,
                "name" => $request->receiverName,
            ),
            "documentType" => $request->DocumentType,
            "documentTypeVersion" => "1.0",
            "dateTimeIssued" => $request->date . "T" . date("h:i:s") . "Z",
            "taxpayerActivityCode" => $request->taxpayerActivityCode,
            "internalID" => $request->internalId,
            "invoiceLines" => [

            ],
            "totalDiscountAmount" => floatval($request->totalDiscountAmount),
            "totalSalesAmount" => floatval($request->TotalSalesAmount),
            "netAmount" => floatval($request->TotalNetAmount),
            "taxTotals" => array(
                array(
                    "taxType" => "T4",
                    "amount" => floatval($request->totalt4Amount),
                ),
                array(
                    "taxType" => "T1",
                    "amount" => floatval($request->totalt2Amount),
                ),
            ),
            "totalAmount" => floatval($request->totalAmount2),
            "extraDiscountAmount" => floatval($request->ExtraDiscount),
            "totalItemsDiscountAmount" => floatval($request->totalItemsDiscountAmount),
        ];

        for ($i = 0; $i < count($request->quantity); $i++) {
            $Data = [
                "description" => $request->invoiceDescription[$i],
                "itemType" => "GS1",
                "itemCode" => $request->itemCode[$i],
                // "itemCode" => "10003834",
                "unitType" => "EA",
                "quantity" => floatval($request->quantity[$i]),
                "internalCode" => "100",
                "salesTotal" => floatval($request->salesTotal[$i]),
                "total" => floatval($request->totalItemsDiscount[$i]),
                "valueDifference" => 0.00,
                "totalTaxableFees" => 0.00,
                "netTotal" => floatval($request->netTotal[$i]),
                "itemsDiscount" => floatval($request->itemsDiscount[$i]),

                "unitValue" => [
                    "currencySold" => "EGP",
                    "amountSold" => 0.00,
                    "currencyExchangeRate" => 0.00,
                    "amountEGP" => floatval($request->amountEGP[$i]),
                ],
                "discount" => [
                    "rate" => 0.00,
                    "amount" => floatval($request->discountAmount[$i]),
                ],
                "taxableItems" => [
                    [

                        "taxType" => "T4",
                        "amount" => floatval($request->t4Amount[$i]),
                        "subType" => ($request->t4subtype[$i]),
                        "rate" => floatval($request->t4rate[$i]),
                    ],
                    [
                        "taxType" => "T1",
                        "amount" => floatval($request->t2Amount[$i]),
                        "subType" => "V009",
                        "rate" => floatval($request->rate[$i]),
                    ],
                ],

            ];
            $invoice['invoiceLines'][$i] = $Data;
        }

        ($request->referencesInvoice ? $invoice['references'] = [$request->referencesInvoice] : "");

        $trnsformed = json_encode($invoice, JSON_UNESCAPED_UNICODE);
        $myFileToJson = fopen("D:\laragon\www\cotton-preprod\EInvoicing\SourceDocumentJson.json", "w") or die("unable to open file");
        fwrite($myFileToJson, $trnsformed);
        return redirect()->route('cer');

    }

// this function for signature

    public function openBat()
    {

        shell_exec('D:\laragon\www\cotton-preprod\EInvoicing/SubmitInvoices2.bat');
        $path = "D:\laragon\www\cotton-preprod\EInvoicing/FullSignedDocument.json";
        $path2 = "D:\laragon\www\cotton-preprod\EInvoicing/Cades.txt";
        $path3 = "D:\laragon\www\cotton-preprod\EInvoicing/CanonicalString.txt";
        $path4 = "D:\laragon\www\cotton-preprod\EInvoicing/SourceDocumentJson.json";

        $fullSignedFile = file_get_contents($path);

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $invoice = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->withBody($fullSignedFile, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions');

        if ($invoice['submissionId'] == !null) {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('sentInvoices')->with('success', 'تم تسجيل الفاتورة بنجاح ');
            // return $invoice->body();

        } else {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            // return $invoice->body();
            return redirect()->route('sentInvoices')->with('error', "يوجد خطأ فى الفاتورة من فضلك اعد تسجيلها");
        }
    }

// this is for create page of invoice
    public function createInvoice()
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Approved&PS=1000');

        $products = $product['result'];
        $codes = DB::table('products')->where('status', 'Approved')->get();
        $ActivityCodes = DB::table('activity_code')->get();
        $allCompanies = DB::table('companies2')->get();
        $taxTypes = DB::table('taxtypes')->get();
        return view('invoices.createInvoice2', compact('allCompanies', 'codes', 'ActivityCodes', 'taxTypes', 'products'));
    }

    // this function for Fill  the customer information

    public function createInvoice2(Request $request)
    {

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Approved&PS=1000');

        $products = $product['result'];
        $codes = DB::table('products')->where('status', 'Approved')->get();
        $ActivityCodes = DB::table('activity_code')->get();
        $allCompanies = DB::table('companies2')->get();
        $taxTypes = DB::table('taxtypes')->get();
        $companiess = DB::table('companies2')->where('id', $request->receiverName)->get();
        return view('invoices.createInvoice2', compact('companiess', 'allCompanies', "codes", 'ActivityCodes', 'taxTypes', "products"));
    }

    public function createInvoice3()
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Approved&PS=1000');

        $products = $product['result'];
        $codes = DB::table('products')->where('status', 'Approved')->get();
        $ActivityCodes = DB::table('activity_code')->get();
        $allCompanies = DB::table('companies2')->get();
        $taxTypes = DB::table('taxtypes')->get();
        return view('invoices.createInvoice3', compact('allCompanies', 'codes', 'ActivityCodes', 'taxTypes', 'products'));
    }

    // this function for Fill  the customer information

    public function createInvoice4(Request $request)
    {

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Approved&PS=1000');

        $products = $product['result'];
        $codes = DB::table('products')->where('status', 'Approved')->get();
        $ActivityCodes = DB::table('activity_code')->get();
        $allCompanies = DB::table('companies2')->get();
        $taxTypes = DB::table('taxtypes')->get();
        $companiess = DB::table('companies2')->where('id', $request->receiverName)->get();
        return view('invoices.createInvoice3', compact('companiess', 'allCompanies', "codes", 'ActivityCodes', 'taxTypes', "products"));
    }

// show pdf printout
    public function showPdfInvoice($uuid)
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $showPdf = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Accept-Language" => 'ar',
        ])->get("https://api.preprod.invoicing.eta.gov.eg/api/v1/documents/" . $uuid . "/pdf");

        return response($showPdf)->header('Content-Type', 'application/pdf');
    }

    public function cancelDocument($uuid)
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "cancelled",
                "reason" => "يوجد خطأ بالفاتورة",
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('sentInvoices')->with('success', 'تم تقديم طلب الغاء الفاتورة بنجاح سيتم الموافقة او الرفض فى خلال 3 ايام');
        } else {
            return redirect()->route('sentInvoices')->with('error', $cancel['error']['details'][0]['message']);
        }
    }

    public function RejectDocument($uuid)
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $cancel = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
        ])->put(
            'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/documents/state/' . $uuid . '/state',
            array(
                "status" => "rejected",
                "reason" => "يوجد خطأ بالفاتورة",
            )
        );
        // return ($cancel);
        if ($cancel->ok()) {
            return redirect()->route('receivedInvoices')->with('success', 'تم تقديم طلب رفض الفاتورة بنجاح سيتم الموافقة او الرفض فى خلال 3 ايام');
        } else {
            return redirect()->route('receivedInvoices')->with('error', $cancel['error']['details'][0]['message']);
        }
    }

}
