<?php

namespace App\Http\Controllers;

use App\Data\store;
use App\Models\DataPaket;
use App\Models\FiturPaket;
use App\Models\DiskonPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Models\EmployedOwner;
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
        $urlPaketPremium = true;
        $employed_data = '';
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
                    $checkPembelianPaket[0] = array('status_paket' => 'Tidak Aktif','status_order' => 'Ditolak');
                }else{
                    if($checkPembelianPaket[0]->status_order == 'Ditolak'){
                        $checkPembelianDiterima = pembelianPaket::select('paket')
                                                                ->where("id_store", $id_store)
                                                                ->where("status_order", 'Diterima')
                                                                ->orderByDesc("order_at")
                                                                ->limit(1)
                                                                ->get();
                        $total_employed_now = EmployedOwner::where('employed_owners.id_store', $id_store)->where('status', 'Aktif')->count();
                        if($checkPembelianDiterima->count() > 0){
                            $paketFitur = new store();
                            $max_employed = $paketFitur->fiturPaket('Karyawan');
                            foreach($max_employed as $data){
                                $max_employed_premium = $data['Premium'];
                                $max_employed_business = $data['Business'];
                            }
                            
                            $urlPaketPremium = $total_employed_now > $max_employed_premium ? false : true;
                            
                            if(!$urlPaketPremium){
                                $employed_data = $this->dbData($id_store);
                            }
                        }
                    }elseif($checkPembelianPaket[0]->status_order == 'Diterima' && $checkPembelianPaket[0]->status_paket == 'Aktif'){
                        $end_paket = $checkPembelianPaket[0]->end_paket_at;
                        $date_now = round(microtime(true) * 1000);
                        if($end_paket < $date_now){
                            pembelianPaket::where("id_store", $id_store)
                                            ->update([
                                                'status_paket' => 'Tidak Aktif'
                                            ]);
                            $checkPembelianPaket = pembelianPaket::where("id_store", $id_store)
                                                ->orderByDesc("order_at")
                                                ->limit(1)
                                                ->get();
                        }
                    }elseif($checkPembelianPaket[0]->status_order == 'Diterima' && $checkPembelianPaket[0]->status_paket == 'Tidak Aktif'){
                        $total_employed_now = EmployedOwner::where('employed_owners.id_store', $id_store)->where('status', 'Aktif')->count();
                        $paketFitur = new store();
                        $max_employed = $paketFitur->fiturPaket('Karyawan');
                        foreach($max_employed as $data){
                            $max_employed_premium = $data['Premium'];
                            $max_employed_business = $data['Business'];
                        }
                        
                        $urlPaketPremium = $total_employed_now > $max_employed_premium ? false : true;

                        if(!$urlPaketPremium){
                            $employed_data = $this->dbData($id_store);
                        }
                    }
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
            'urlPaketPremium' => $urlPaketPremium,
            'employed_data' => $employed_data,
            'title' => 'Home'
        ]);
    }

    public function dbData($id_store){
        $data = EmployedOwner::leftJoin('users','employed_owners.username','=','users.username')
                            ->leftJoin('profile_users','employed_owners.username','=','profile_users.username')
                            ->select(
                                'users.username AS username',
                                'users.email AS email',
                                'profile_users.photo_profile AS foto',
                                'profile_users.first_name AS first_name',
                                'profile_users.second_name AS second_name',
                                'profile_users.contact AS no_telpn',
                                'employed_owners.role AS role',
                                'employed_owners.status AS status',
                            )
                            ->where('employed_owners.id_store', $id_store)
                            ->orderBy('users.username')
                            ->get();

        

        return $data;
    }
}
