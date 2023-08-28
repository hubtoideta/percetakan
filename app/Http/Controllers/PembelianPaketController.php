<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\pembelianPaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembelianPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            return view('dashView.pembelian_paket', [
                'userLogin' => $userData,
                'fotoProfil' => $fotoProfil,
                'title' => 'Pembelian Paket'
            ]);
        }else{
            return redirect()->route('home');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pembelianPaket $pembelianPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pembelianPaket $pembelianPaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pembelianPaket $pembelianPaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pembelianPaket $pembelianPaket)
    {
        //
    }
}
