<?php

namespace App\Http\Controllers;

use App\Models\DataPaket;
use App\Models\FiturPaket;
use App\Models\DiskonPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Models\pembelianPaket;
use App\Models\InformationStore;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $checkPembelianPaket = [];
        $alertData = false;
        if($userData->category == "Owner"){
            $informationStore = InformationStore::where("username_owner", $userData->username)->get();
            if($informationStore->count() == 0){
                $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif');
                $alertData = true;
            }else{
                $id_store = $informationStore[0]->id_store;
                $checkPembelianPaket = pembelianPaket::where("id_store", $id_store)
                    ->orderByDesc("order_at")
                    ->limit(1)
                    ->get();
                if($checkPembelianPaket->count() == 0){
                    $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif','status_order' => 'Ditolak');
                }
            }
        }elseif($userData->category == "Freelance"){
            $alertData = true;
        }

        /* Return view */
        return view('dashView.home', [
            'userLogin' => $userData,
            'alertData' => $alertData,
            'fotoProfil' => $fotoProfil,
            'listPaket' => $this->dbPaket()['listPaket'],
            'fiturPaket' => $this->dbPaket()['fiturPaket'],
            'checkPembelianPaket' => $checkPembelianPaket,
            'title' => 'Home'
        ]);
    }
}
