<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
         $company = Company::first();

        return view('company.index', compact('company'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::first();

        return view('company.edit', compact('company'));
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

        $company = Company::findOrFail($id);

        $request->validate([

            'name_ar'         => 'required|min:3|max:255',
            'name_en'         => 'required|min:3|max:255',
            'primary_address' => 'required',
            'reg_number'      => 'required|numeric',
            'reg_number'      => 'min:9',
            'email'           => 'required|email',
        ]);

        $input = $request->except(['logo']);

        $file = $request->file('logo');

        if($file){

            $request->validate([

                'logo'         => 'mimes:jpg,png,jpeg',
            ]);

            $fileName = $file->getClientOriginalExtension();

            $fileName = 'E-tax' . uniqid() . '.' .$fileName;

            $file->move('images/', $fileName);

            $input['logo'] = $fileName;

        }else{

           $input['logo'] = $company->logo;

        }



        $company->update($input);

        session()->flash('message', 'Updated Successfully');

        return redirect('company');

    }
}
