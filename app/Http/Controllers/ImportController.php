<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\CategoryImport;

class ImportController extends Controller
{

    public function index()
    {
         return view('import.index');
    }


    public function categoryimport(Request $request)
    {
         $request->validate([
            'file' => 'required'
         ]);

        Excel::import(new CategoryImport, request()->file('file'));

         return view('import.index');
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
     * @param  \App\Models\ImportController  $importController
     * @return \Illuminate\Http\Response
     */
    public function show(ImportController $importController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportController  $importController
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportController $importController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportController  $importController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportController $importController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportController  $importController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportController $importController)
    {
        //
    }
}
