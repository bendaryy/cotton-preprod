<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PackagesController extends Controller
{
    public function showAllPackages()
    {
        {
            $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
                'grant_type' => 'client_credentials',
                'client_id' => auth()->user()->details->client_id,
                'client_secret' => auth()->user()->details->client_secret,
                'scope' => "InvoicingAPI",
            ]);

            $showPackages = Http::withHeaders([
                "Authorization" => 'Bearer ' . $response['access_token'],
            ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentPackages/requests?pageSize=1000000');

            // return $showPackages['result'];
            $packages = $showPackages['result'];
            return view('packages.index', compact('packages'));

        }

    }

    public function addFullPackage()
    {
        return view('packages.createfull');
    }

    public function addSummaryPackage()
    {
        return view('packages.createsummary');
    }

    public function sendFullPackage(Request $request)
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $makePackage = [
            "type" => "Full",
            "format" => $request->format,
            "queryParameters" => [
                "dateFrom" => $request->dateFrom . "T" . date("h:i:s") . "Z",
                "dateTo" => $request->dateTo . "T" . date("h:i:s") . "Z",
                "statuses" => [
                    $request->status,
                ],
                // "receiverSenderType" => $request->type,
            ],
        ];

        $trnsformed = json_encode($makePackage, JSON_UNESCAPED_UNICODE);

        $sendPackage = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
            "Accept-Language" => "ar",

        ])->withBody($trnsformed, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentPackages/requests');
        if ($sendPackage->ok() == true) {
            return redirect()->route("showAllPackages")->with("success", " تم إنشاء الحزمة رقم " . $sendPackage['requestId']);
        } else {
            return redirect()->route("showAllPackages")->with("error", $sendPackage['error']['details'][0]['message']);
        }

    }

    public function sendSummaryPackage(Request $request)
    {
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $makePackage = [
            "type" => "Summary",
            "format" => $request->format,
            "queryParameters" => [
                "dateFrom" => $request->dateFrom . "T" . date("h:i:s") . "Z",
                "dateTo" => $request->dateTo . "T" . date("h:i:s") . "Z",
                "statuses" => [
                    $request->status,
                ],
                // "receiverSenderType" => $request->type,
            ],
        ];

        $trnsformed = json_encode($makePackage, JSON_UNESCAPED_UNICODE);

        $sendPackage = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
            "Accept-Language" => "ar",

        ])->withBody($trnsformed, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentPackages/requests');

        if ($sendPackage->ok() == true) {
            return redirect()->route("showAllPackages")->with("success", " تم إنشاء الحزمة رقم " . $sendPackage['requestId']);
        } else {
            return redirect()->route("showAllPackages")->with("error", $sendPackage['error']['details'][0]['message']);
        }

    }

    public function downloadPackage($id)
    {

        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $download = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-type" => "application/octet-stream",
        ])->get("https://api.preprod.invoicing.eta.gov.eg/api/v1/documentPackages/$id");

        return response($download)->header('Content-Type', 'application/zip');

    }
}
