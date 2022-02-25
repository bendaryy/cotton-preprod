<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{

    public function index()
    {

        $products = Products::count();

        $approved = Products::whereStatus('Approved')->count();

        $pending = Products::whereStatus('Submitted')->count();

        return view('index', compact('products','approved', 'pending'));
    }
}
