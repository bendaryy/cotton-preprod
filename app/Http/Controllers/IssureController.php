<?php

namespace App\Http\Controllers;

use App\Models\Activitycode;
use App\Models\Country;
use App\Models\Details;
use App\Models\Issure;
use Illuminate\Http\Request;

class IssureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issures = Details::where( 'user_id',auth()->user()->id)->get();

        return view('issure.index', compact('issures'));
    }

    public function edit($id)
    {
        $issure = Issure::findOrFail($id);

        $activity = Activitycode::all();

        $countries = Country::all();

        return view('issure.edit', compact('issure', 'activity', 'countries'));
    }

    public function create()
    {

        $activity = Activitycode::all();

        $countries = Country::all();

        return view('issure.create', compact('activity', 'countries'));
    }

    public function store(Request $request)
    {

        $request->validate([

            "name" => "required",
            "branchID" => "required",
            "country" => "required",
            "governate" => "required",
            "regionCity" => "required",
            "street" => "required",
            "buildingNumber" => "required",
            "type" => "required",
            "regid" => "required",
        ]);

        $issure = Issure::create($request->all());

        session()->flash('message', 'Created Successfully');

        return redirect('issure');

    }

    public function update(Request $request, $id)
    {

        $request->validate([

            "name" => "required",
            "branchID" => "required",
            "country" => "required",
            "governate" => "required",
            "regionCity" => "required",
            "street" => "required",
            "buildingNumber" => "required",
            "type" => "required",
            "regid" => "required",
        ]);

        $issure = Issure::findOrFail($id);

        $issure->update($request->all());

        session()->flash('message', 'Updated Successfully');

        return redirect('issure');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issure = Issure::findOrFail($id)->delete();

        session()->flash('message', 'Deleted Successfully');

        return redirect('issure');
    }
}
