<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class RemoteController extends Controller
{

    public function updatestatus (){

        //TODO::Create The Cron Jop For AutoRun

        $res = UpdateStatis();




        if($res){


            $products = [];

            foreach($res as $index => $result){

                $itemcode = explode('-',  $result['itemCode']);

                $products[$index]['itemCode']      =  $itemcode[2];
                $products[$index]['status']        = $result['status'];
                $products[$index]['statusReason']  = $result['statusReason'];
            }


            foreach($products as $prod){

                $product = Products::where('code', '=', $prod['itemCode'])->first();

                if($product){

                    $product->update([
                        'status'       => $prod['status'],
                        'statusReason' => $prod['statusReason'],
                    ]);

                }
            }

            dd('done');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
