<?php

namespace App\Http\Controllers;

use App\Models\DataPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiskonPaket;
use App\Models\FiturPaket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DataPaketController extends Controller
{

    public function dbPaket(){
        $listPaket = DataPaket::select('nama_paket','harga_paket')->orderByDesc('nama_paket')->get();

        $diskonPaket = DiskonPaket::leftJoin('data_pakets','diskon_pakets.nama_paket_diskon','=','data_pakets.nama_paket')
                        ->select('diskon_pakets.*','data_pakets.harga_paket AS harga')
                        ->orderByDesc('data_pakets.nama_paket')
                        ->get();

        $fiturPaket = FiturPaket::select('nama_fitur_paket','Premium','Business')->get();

        $result['diskonPaket'] = $diskonPaket;

        $result['listPaket'] = $listPaket;

        $result['fiturPaket'] = $fiturPaket;

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
            'diskonPaket' => $this->dbPaket()['diskonPaket'],
            'fiturPaket' => $this->dbPaket()['fiturPaket'],
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

    public function updateDiskonPaket(Request $request){
        $validation = Validator::make($request->all(),
            [
                'diskon3.*' => 'numeric|min:1',
                'diskon6.*' => 'numeric|min:1',
                'diskon12.*' => 'numeric|min:1',
                'diskon24.*' => 'numeric|min:1',
            ],
            [
                'diskon3.*.numeric' => 'Data yang anda masukkan bukan angka',
                'diskon3.*.min' => 'Minimal 1% potongan harga',
                'diskon6.*.numeric' => 'Data yang anda masukkan bukan angka',
                'diskon6.*.min' => 'Minimal 1% potongan harga',
                'diskon12.*.numeric' => 'Data yang anda masukkan bukan angka',
                'diskon12.*.min' => 'Minimal 1% potongan harga',
                'diskon24.*.numeric' => 'Data yang anda masukkan bukan angka',
                'diskon24.*.min' => 'Minimal 1% potongan harga',
            ]
        );

        if($validation->fails()){
            return redirect()
                        ->route('paket')
                        ->withErrors($validation)
                        ->withInput();
        }

        foreach($this->dbPaket()['listPaket'] as $key => $value){
            DiskonPaket::where('nama_paket_diskon', $value['nama_paket'])->update([
                'tiga_bulan' => $request->diskon3[$key],
                'enam_bulan' => $request->diskon6[$key],
                'dua_belas_bulan' => $request->diskon12[$key],
                'dua_puluh_empat_bulan' => $request->diskon24[$key],
            ]);
        }
        return redirect()->route('paket')->with('successDis', 'Data Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPaket $dataPaket)
    {
        //
    }
}
