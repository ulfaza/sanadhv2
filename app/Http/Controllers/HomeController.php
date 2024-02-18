<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panitia/home');
    }

    public function siswa()
    {
        return view('siswa/home');
    }

    public function paper()
    {
        return view('paper/home');
    }

    public function bp()
    {
        return view('bp/home');
    }
}
