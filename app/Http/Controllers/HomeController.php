<?php

namespace App\Http\Controllers;

use App\Models\InformationStore;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /* VIEW HOME */
    public function index(){
        /* User Login */
        $userData = Auth::user(); 
        /* Data profil user Login */
        $profileUser = ProfileUser::select('photo_profile')->find($userData->username);
        /* Count data user */
        $totalData = $profileUser ? $profileUser->count() : 0;
        
        /* Photo profile account */
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        /* Alert untuk Owner & Freelance */
        $alertData = false;
        if($userData->category == "Owner"){
            $informationStore = InformationStore::where("username_owner", $userData->username)->get();
            if($informationStore->count() == 0){
                $alertData = true;
            }
        }elseif($userData->category == "Freelance"){
            $alertData = true;
        }

        /* Return view */
        return view('dashView.Home', [
            'userLogin' => $userData,
            'alertData' => $alertData,
            'fotoProfil' => $fotoProfil,
            'title' => 'Home'
        ]);
    }
}
