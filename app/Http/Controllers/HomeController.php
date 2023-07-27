<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* VIEW HOME */
    public function index(){
        return view('dashView.Home', [
            'title' => 'Home'
        ]);
    }
}
