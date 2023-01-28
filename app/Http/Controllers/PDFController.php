<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        echo "test pdf";
        return view('request.testpdf');
    }
}
