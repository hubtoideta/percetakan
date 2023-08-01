<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /* VIEW HOME */
    public function index(){
        $userData = Auth::user();
        return view('dashView.Home', [
            'userLogin' => $userData,
            'title' => 'Home'
        ]);
    }
}
