<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Customer;
use App\Models\Taxtype;
use App\Http\Requests\DocumentRequest;
use App\Models\Orderitem;
use App\Models\Itemtax;
use App\Models\Order;
use App\Models\Unittype;

class DocumentController extends Controller
{

    public function notsubmitted()
    {
         $orders = Order::whereSubmitted(0)->latest()->get();

         return view('order.notsubmitted', compact('orders'));
    }

    public function finish($id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => 1]);

        return redirect('notsubmitted');
    }


    public function create()
    {
         $products = Products::whereStatus('Approved')->latest()->get();

         $customers = Customer::latest()->get();

         $taxtypes = Taxtype::whereNull('parent')->get();

         $order = Order::whereStatus(0)->first();

         if(!$order){

           $order = Order::create(['status' => 0]);
         }

         $unittype = Unittype::all();

         return view('document.submit', compact('products', 'customers', 'taxtypes', 'order', 'unittype'));

         return view('document.create', compact('products', 'customers', 'taxtypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        dd($request->all());



    }

    public function storeproduct(Request $request)
    {

        $request->validate([

            'product_id'         => 'required',
            'discount'           => 'required',
            'subtype'            => 'required',
            'type'               => 'required',
            'descreption'        => 'required',
            'total'              => 'required',
            'discount'           => 'required',
            'price'              => 'required',
            'qty'                => 'required',
            'unittype'           => 'required',

        ]);

        $product = Products::findOrFail($request->product_id);

        $price = $request->price;

        $discount = $request->discount;

        $priceAfterDiscount = $price - $discount;

        $subs = $request->subtype;

        $taxtotal = 0;

        foreach($subs as $index=> $sub){

            $taxsubtype = Taxtype::where('code', '=', $sub)->first();

            $cuttype = $taxsubtype->type;

            if($cuttype == 'amount'){ // If T4 Ninus

                $request->validate(['amount'  => 'required' ]);

                $taxtotal += $request->amount[$index];

               $priceAfterTax =  $priceAfterDiscount + $request->amount[$index];

            }else{

                $request->validate(['percentage'  => 'required' ]);

                $taxtotal += $request->percentage[$index];

                $priceAfterTax =  $priceAfterDiscount + ( $priceAfterDiscount * $request->percentage[$index] /100);

            }

        }





        $total = $priceAfterTax * $request->qty;



        // 'product_id'         => 'required',
        // 'discount'           => 'required',
        // 'subtype'            => 'required',
        // 'type'               => 'required',
        // 'descreption'        => 'required',
        // 'total'              => 'required',
        // 'discount'           => 'required',
        // 'price'              => 'required',
        // 'qty'                => 'required',
     $item =    Orderitem::create([

            'order_id'           => $request->order_id,
            'description'        => $request->descreption,
            'itemType'           => 'EGS',
            'itemCode'           => $product->egs,
            'unitType'           => 'EA',
            'quantity'           => $request->qty,
            'internalCode'       => $product->code,
            'salesTotal'         => $total,
            'total'              => $total,
            'valueDifference'    => 0.00,
            'totalTaxableFees'   => $taxtotal,
            'netTotal'           => $total,
            'itemsDiscount'      => $request->discount,
            'currencySold'       => "EGP",
            'amountEGP'          => $request->price,
            'discountamount'     => $request->discount,
            'discountrate'       => $request->discount,
        ]);



        foreach($subs as $index=> $sub){

            $taxitem = new Itemtax();

            $taxitem->taxType = $request->type[$index];

            $taxitem->item_id = $item->id;

            $taxitem->subType = $sub;

            $taxsubtype = Taxtype::where('code', '=', $sub)->first();

            $cuttype = $taxsubtype->type;

            if($cuttype == 'amount'){

                $taxitem->amount = $request->amount[$index];

            }else{
                $taxitem->rate  = $request->percentage[$index];
            }

            $taxitem->save();

        }


        session()->flash('message', 'Created Successfully');

        return redirect()->route('document.create');

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function cancelorder($id)
    {
         Order::findOrFail($id)->delete();

         session()->flash('message', 'Deleted Successfully');

         return redirect('/');

    }


    public function deleteproduct($id)
    {
        Orderitem::findOrFail($id)->delete();

         session()->flash('message', 'Deleted Successfully');

         return redirect()->back();

    }


    public function getproduct(Request $request)
    {
        return  Products::findOrFail($request->product);
    }

    public function gettaxtype(Request $request)
    {
        return  Taxtype::where("parent", $request->parent)->get();
    }


    public function updatorderdata(Request $request)
    {

        //TODO::Calculate Total

        $order = Order::whereStatus(0)->first();

        $order->update($request->all());

        return 'mashy';
    }





    public function submitorder($id)
    {
        $order = Order::findOrFail($id);

     $result =  documentSubmit($order);

     dd($result);

    }
}
