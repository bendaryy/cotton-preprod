<?php

namespace App\Http\Controllers;

use App\Models\Apisetting;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $addProduct = [
        //     "items" => [[
        //         "codeType" => "EGS",
        //         "itemCode" => "EG-" . auth()->user()->details->company_id . '-' . $request->egs,
        //         "parentCode" => $request->gpc,
        //         "codeName" => $request->name_en,
        //         "codeNameAr" => $request->name_ar,
        //         "activeFrom" => $request->active_from,
        //         "activeTo" => $request->active_to,
        //         "description" => $request->desc_en,
        //         "descriptionAr" => $request->desc_ar,
        //         "requestReason" => "Request reason text",
        //     ]],

        // ];

        // $encode = strin($addProduct);

        // $addProductJson = file_get_contents($encode);

// $input = $request->except(['egs']);

// $tax = Apisetting::first();

// $input['egs'] = 'EG-' . $tax->commercial_number . '-' . $request->egs;

// $input['code'] = $request->egs;

// Products::create($input);

// return redirect('products');

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $request->validate([
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3',
            'desc_ar' => 'required|min:5',
            'desc_en' => 'required|min:5',
            'active_from' => 'required|date',
            // 'price' => 'required|numeric',
            'gpc' => 'required|numeric|min:8',
            'egs' => 'required',
        ]);

        $addProduct = '{
            "items": [

                {
                    "codeType": "' . "EGS" . '",
                    "parentCode": "' . $request->gpc . '",
                    "itemCode": "' . "EG-" . auth()->user()->details->company_id . '-' . $request->egs . '",
                    "codeName": "' . $request->name_en . '",
                    "codeNameAr": "' . $request->name_ar . '",
                    "activeFrom": "' . $request->active_from . '",
                    "activeTo": "' . $request->active_to . '",
                    "description": "' . $request->desc_en . '",
                    "descriptionAr": "' . $request->desc_ar . '",
                    "requestReason": "' . "Request reason text" . '",
                },

            ]
        }';

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->withBody($addProduct, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/codes');

        // return  $product['failedItems'][0]['errors'][0];
        // return $product;

        if ($product["passedItemsCount"] === 0) {
            return redirect()->route('pending')->with('error', $product['failedItems'][0]['errors'][0]);

        }
        if ($product["passedItemsCount"] > 0) {
            return redirect()->route('pending')->with('success', "تم ارسال المنتج (قيد الإنتظار)" . ' ' . ($product['passedItems'][0]['itemCode']));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $request->validate([
            'name_ar' => 'required|min:3|unique:products,name_ar,' . $id,
            'name_en' => 'required|min:3|unique:products,name_en,' . $id,
            'desc_ar' => 'required|min:5',
            'desc_en' => 'required|min:5',
            'price' => 'required|numeric',
            'gpc' => 'required|numeric|min:8|exists:categories,code',
            'egs' => 'required|numeric|unique:products,egs,' . $id,
        ]);

        $input = $request->except(['egs']);

        $tax = Apisetting::first();

        $input['egs'] = 'EG-' . $tax->commercial_number . '-' . $request->egs;

        $input['code'] = $request->egs;

        $product->update($input);

        session()->flash('message', 'Updated Successfully');

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        $product->delete();

        session()->flash('message', 'Deleted Successfully');

        return redirect('products');

    }

    public function submit()
    {
        $products = Products::whereNull('status')->latest()->get();

        return view('products.submit', compact('products'));

    }

    public function sendproducts(Request $request)
    {

        $request->validate([
            'product_ids' => 'required|array',
        ]);

        $list = [];

        $tax = Apisetting::first();

        foreach ($request->product_ids as $id) {

            $product = Products::findOrFail($id);

            $list['codeType'] = 'EGS';
            $list['parentCode'] = $product->gpc;
            $list['itemCode'] = $product->egs;
            $list['codeName'] = $product->name_en;
            $list['codeNameAr'] = $product->name_ar;
            $list['activeFrom'] = $product->active_from;
            $list['activeTo'] = $product->active_to;
            $list['description'] = $product->desc_en;
            $list['descriptionAr'] = $product->desc_ar;
            $list['requestReason'] = "Request reason text";
        }

        $response = SendProducts($list);

        if (!is_null($response)) {

            if ($response['error']) {

                $product->update([
                    'status' => 'Error',
                    'reason' => $response['msg'],
                ]);

            } else {

                $product->update(['status' => 'Submitted']);

            }

            session()->flash('message', 'Submitted Successfully');

            return redirect()->back();

        } else {

            return redirect()->back()->withErrors('Code Error');
        }

    }

    public function rejected()
    {
        $products = Products::whereStatus('Error')->latest()->get();

        return view('products.rejected', compact('products'));

    }

    public function active()
    {
        // $products = Products::whereStatus('Approved')->latest()->get();

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

        return view('products.active', compact('products'));

    }

    public function pending()
    {
        // $products = Products::whereStatus('Submitted')->latest()->get();

        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => auth()->user()->details->client_id,
            'client_secret' => auth()->user()->details->client_secret,
            'scope' => "InvoicingAPI",
        ]);

        $product = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->get('https://api.preprod.invoicing.eta.gov.eg/api/v1.0/codetypes/requests/my?Active=true&Status=Submitted&PS=1000');

// return $product['result'];
        // $products = Products::latest()->get();
        $products = $product['result'];

        return view('products.pending', compact('products'));

    }

}
