<?php
use Illuminate\Support\Facades\Http;
use App\Models\Apisetting;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Issure;


  function TaxLogin(){

    $setting = Apisetting::first();

    $response = Http::asForm()->withHeaders([
    ])->post('https://id.preprod.eta.gov.eg/connect/token', [
        'grant_type'     => 'client_credentials',
        'client_id'      => $setting->client_id,
        'client_secret'  => $setting->secret_id,
        'scope'          => 'InvoicingAPI',
    ]);

    $res =  $response->json();

    $token = $res['access_token'];

    $setting = Apisetting::first();

    $setting->update(['access_token' => $token]);

    return $token;

}


    function SendProducts($list){


      $token =  TaxLogin();

       $setting = Apisetting::first();

    //    return json_encode($list);
          $setting->access_token;

        $setting->update(['access_token' => $token]);

        // try{


        //  $response = Http::withToken($setting->access_token)->withHeaders([
        //     'Content-Type: application/json',
        // ])->withBody($list, '')->post('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/codes')->json();

        // }catch (GuzzleHttp\Exception\ClientException $e) {

        //     $response = $e->getResponse();

        //     $responseBodyAsString = $response->getBody()->getContents();

        //     return   $responseBodyAsString;
        // }

        // return $response;


        $curl = curl_init();

        // return $list;

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/codes',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "items": [

                {
                    "codeType": "'.$list['codeType'] .'",
                    "parentCode": "'.$list['parentCode'] .'",
                    "itemCode": "'.$list['itemCode'] .'",
                    "codeName": "'.$list['codeName'] .'",
                    "codeNameAr": "'.$list['codeNameAr'] .'",
                    "activeFrom": "'.$list['activeFrom'] .'",
                    "activeTo": "'.$list['activeTo'] .'",
                    "description": "'.$list['description'] .'",
                    "descriptionAr": "'.$list['descriptionAr'] .'",
                    "requestReason": "'.$list['requestReason'] .'",
                },

            ]
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $setting->access_token,
            'Content-Type: application/json',
        ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);



          $response = json_decode(trim($response), TRUE);

         if(!is_null( $response)){


        if(!is_null($response) || !is_null($response['failedItems']) || !exists($response['failedItems'])){

            $msg =    ($response['failedItems'][0]['errors'][0]) ??  $response['failedItems'][0]['errors'][0];

            $res = [
                'error' => '400',
                'msg' => $msg
            ];

            return  $res;
        }

    }

        return $response;

    }


        /**
     * Status Update
     * @should Use Cron Job
     */

     function UpdateStatis(){

       $login = TaxLogin();

      $setting = Apisetting::first();


        // Get The Res


        $curl = curl_init();

        curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Approved&PageSize=10&PageNumber=1&OrderDirections=Descending',
        CURLOPT_URL => 'https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?OrderDirections=Descending',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept-Language: en',
            'Authorization: Bearer ' . $setting->access_token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode(trim($response), TRUE);


        return $response['result'];

     }




     function getCOuntryName($code){

        $country = Country::whereCode($code)->first();

        if(! $country){

            return $code;
        }

        if (LaravelLocalization::getCurrentLocale() == 'en'){

            return $country->Desc_en;

        }else{

            return $country->Desc_ar;

        }
     }







     function documentSubmit($order){

      //  $token =  TaxLogin();

        $setting = Apisetting::first();

        $issure = Issure::first();

        $customer = Customer::findOrFail($order->customer_id);

        try{


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "documents": [
        {
            "issuer": {
                "address": {
                    "branchID":' . $issure->branchID .',
                    "country": ' . $issure->country .',
                    "governate":' . $issure->governate .',
                    "regionCity": ' . $issure->regionCity .',
                    "street": ' . $issure->street .',
                    "buildingNumber": ' . $issure->buildingNumber .',
                    "postalCode": ' . $issure->postalCode .',
                    "floor": ' . $issure->floor .',
                    "room": ' . $issure->room .',
                    "landmark": ' . $issure->country .',
                    "additionalInformation": ' . $issure->additionalInformation .',
                },
                "type": ' . $issure->type .',
                "id": ' . $setting->commercial_number .',
                "name": ' . $issure->country .',
            },
            "receiver": {
                "address": {
                    "country": ' . $customer->country .',
                    "governate": ' . $customer->governorate .',
                    "regionCity": ' . $customer->city .',
                    "street": ' . $customer->street .',
                    "buildingNumber": ' . $customer->building .',
                    "postalCode": ' . $customer->post .',
                    "floor":' . $customer->floor .',
                    "room": ' . $customer->flat .',
                    "landmark": ' . $customer->land .',
                    "additionalInformation": ' . $customer->additional .'
                },
                "type": "B",
                "id": ' . $customer->reg_numer .',
                "name": ' . $customer->name .',
            },
            "documentType": "I",
            "documentTypeVersion": "0.9",
            "dateTimeIssued": "2021-02-07T02:04:45Z",
            "taxpayerActivityCode": "4620",
            "internalID": ' . $order->internalid  .',,
            "purchaseOrderReference": "P-233-A6375",
            "purchaseOrderDescription": "purchase Order description",
            "salesOrderReference": "1231",
            "salesOrderDescription": "Sales Order description",
            "proformaInvoiceNumber": "SomeValue",
            "payment": {
                "bankName": ' . $customer->bank_name .',
                "bankAddress": ' . $customer->bank_address .',
                "bankAccountNo": ' . $customer->bank_accountno .',
                "bankAccountIBAN": ' . $customer->bank_iban .',
                "swiftCode": ' . $customer->swift_code .',
                "terms": ' . $customer->payment_terms .',
            },
            "delivery": {
                "approach":  ' . $customer->approach .',
                "packaging":  ' . $customer->packaging .',
                "dateValidity":  ' . $customer->validity .',
                "exportPort":  ' . $customer->export_port .',
                "grossWeight":  ' . $customer->cross_weight .',
                "netWeight":  ' . $customer->net_weight .',
                "terms":  ' . $customer->delivery_terms .',
            },
            "invoiceLines": [
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 1,
                    "internalCode": "IC0",
                    "salesTotal": 111111111111.00,
                    "total": 111111111111.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                        "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                        "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                },


            ],
            "totalDiscountAmount": 0,
            "totalSalesAmount": 555555555555.00,
            "netAmount": 555555555555.00,
            "taxTotals": [
                {
                    "taxType": "T1",
                    "amount": 0
                }
            ],
            "totalAmount": 555555555555.00,
            "extraDiscountAmount": 0,
            "totalItemsDiscountAmount": 0,
            "signatures": [
                {
                    "signatureType": "I",
                    "value":  ""
                }
            ]
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $setting->access_token,
  ),
));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode(trim($response), TRUE);

    return  $response;

          }catch (GuzzleHttp\Exception\ClientException $e) {

            return  $response = $e;

            $responseBodyAsString = $response->getBody()->getContents();

            return   $responseBodyAsString;
        }


     }
