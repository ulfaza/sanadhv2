<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LteController extends Controller
{
    public function index(){
    	return view('lte/admin');
    }
}
