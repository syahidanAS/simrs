<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiagnoseIcdxController extends Controller
{
    public function index(){
        return view('pages.master.diagnose_icd_x.index');
    }
}
