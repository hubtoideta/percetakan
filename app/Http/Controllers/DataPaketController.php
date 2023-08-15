<?php

namespace App\Http\Controllers;

use App\Models\DataPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiskonPaket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DataPaketController extends Controller
{

    public function dbPaket(){
        $listPaket = DataPaket::select('nama_paket','harga_paket')->orderByDesc('nama_paket')->get();

        $diskonPaket = DiskonPaket::leftJoin('');

        $result['listPaket'] = $listPaket;

        return $result;
    }

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

        /* Return view */
        return view('dashView.paket_langganan', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'listPaket' => $this->dbPaket()['listPaket'],
            'title' => 'Paket & Fitur Langganan'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateHargaPaket(Request $request){
        $validation = Validator::make($request->all(), 
            [
                'harga.*' => 'numeric|min:50000'
            ],
            [
                'harga.*.numeric' => 'Data yang anda masukkan bukan angka',
                'harga.*.min' => 'Harga tidak boleh di bawah Rp.50.000',
            ]
        );

        if($validation->fails()){
            return redirect()
                        ->route('paket')
                        ->withErrors($validation)
                        ->withInput();
        }

        foreach($this->dbPaket()['listPaket'] as $key => $value){
            DataPaket::where('nama_paket', $value['nama_paket'])->update([
                'harga_paket' => $request->harga[$key]
            ]);
        }
        return redirect()->route('paket')->with('success', 'Data Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPaket $dataPaket)
    {
        //
    }
}
