<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /* VIEW HOME */
    public function index(){
        $userData = Auth::user();
        $profileUser = ProfileUser::select('photo_profile', 'first_name', 'second_name', 'contact')->where('email', $userData->email)->first();
        $totalData = ProfileUser::count();
        
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }
        return view('dashView.Home', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'title' => 'Home'
        ]);
    }
}
