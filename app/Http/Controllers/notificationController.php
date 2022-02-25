<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class notificationController extends Controller
{
    public function getNotifications()
    {

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $notification = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-type" => "application/json",
        ])->get("https://api.preprod.invoicing.eta.gov.eg/api/v1/notifications/taxpayer?pageSize=100");

        $notifications = $notification['result'];

        return view('notification.index', compact('notifications'));

    }
    public function getNotificationsDashboard()
    {

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $notification = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-type" => "application/json",
        ])->get("https://api.preprod.invoicing.eta.gov.eg/api/v1/notifications/taxpayer?pageSize=100");

        $notifications = $notification['result'];

        return view('layouts.main', ["notifications" => $notifications]);

    }
}
