<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class dataStoreController extends Controller{
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

        if($userData->category == "Developer"){
            /* Return view */
            return view('dashView.data_toko', [
                'userLogin' => $userData,
                'fotoProfil' => $fotoProfil,
                // 'data' => $this->dbPembelianPaket($page, $request->codeOrder),
                'title' => 'Data Toko'
            ]);
        }else{
            return redirect()->route('home');
        }
    }
}
