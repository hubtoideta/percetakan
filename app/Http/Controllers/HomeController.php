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
        $userData = Auth::user();
        $profileUser = ProfileUser::select('photo_profile')->find($userData->username);
        $totalData = $profileUser->count();
        
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        $alertData = false;
        if($userData->category == "Owner"){
            $informationStore = InformationStore::where("username_owner", $userData->username)->get();
            if($informationStore->count() == 0){
                $alertData = true;
            }
        }

        return view('dashView.Home', [
            'userLogin' => $userData,
            'alertData' => $alertData,
            'fotoProfil' => $fotoProfil,
            'title' => 'Home'
        ]);
    }
}
