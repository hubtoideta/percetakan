<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        /* Login Auth */
        $userData = Auth::user();
        $userEmail = $userData->email;
        $profileUser = DB::table('profile_users')->where('email', $userEmail)->value('photo_profile', 'first_name', 'second_name', 'contact');
        $totalData = DB::table('profile_users')->count();
        
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        return view('dashView.profile', [
            'profileUser' => $profileUser,
            'fotoProfil' => $fotoProfil,
            'totalData' => $totalData,
            'userLogin' => $userData,
            'title' => 'Profil'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        $request->validate([
            'photo_profile' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileUser $profileUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileUser $profileUser)
    {
        //
    }
}
