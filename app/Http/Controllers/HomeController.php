<?php

namespace App\Http\Controllers;

use App\Helpers\Main as HelpersMain;
use App\Http\Controllers\Helpers\Main;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // return HelpersMain::getMenus();
        return view('pages.home');
    }
}
