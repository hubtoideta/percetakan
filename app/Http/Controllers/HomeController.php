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
        $profileUser = ProfileUser::select('photo_profile')->find($userData->username);
        $totalData = $profileUser->count();
        
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
