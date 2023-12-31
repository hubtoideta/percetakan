<?php

namespace App\Http\Controllers;

use App\Models\FiturPaket;
use App\Models\DiskonPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Models\EmployedOwner;
use App\Models\pembelianPaket;
use App\Models\InformationStore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class pembayaranController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function premiumPaket(){
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

        $is_process = $this->checkEmployed('Premium', $userData->username);
        if($is_process){
            $diskonPaket = DiskonPaket::leftJoin('data_pakets','diskon_pakets.nama_paket_diskon','=','data_pakets.nama_paket')
                            ->select('diskon_pakets.*','data_pakets.harga_paket AS harga','data_pakets.nama_paket AS paket')
                            ->where('data_pakets.nama_paket', 'Premium')
                            ->orderByDesc('data_pakets.nama_paket')
                            ->get();
    
            $diskonPaket = $diskonPaket[0];
    
            $checkout['namaPaket'] = $diskonPaket['paket'];
            $checkout['hargaNormal'] = $diskonPaket['harga'];
            $checkout['diskonTigaBulan'] = $diskonPaket['tiga_bulan'];
            $checkout['diskonEnamBulan'] = $diskonPaket['enam_bulan'];
            $checkout['diskonDuaBelasBulan'] = $diskonPaket['dua_belas_bulan'];
            $checkout['diskonDuaPuluhEmpatBulan'] = $diskonPaket['dua_puluh_empat_bulan'];
    
            /* 3 BULAN PRICE */
            $harga_tiga_bulan = $diskonPaket['harga']*3;
            $potongan_harga_tiga_bulan = $harga_tiga_bulan*($checkout['diskonTigaBulan']/100);
            $harga_tiga_bulan_diskon = $harga_tiga_bulan-$potongan_harga_tiga_bulan;
            $checkout['paketTigaBulan'] = $harga_tiga_bulan_diskon/3;
            $checkout['potonganPaketTigaBulan'] = $potongan_harga_tiga_bulan;
            
            /* 6 BULAN PRICE */
            $harga_enam_bulan = $diskonPaket['harga']*6;
            $potongan_harga_enam_bulan = $harga_enam_bulan*($checkout['diskonEnamBulan']/100);
            $harga_enam_bulan_diskon = $harga_enam_bulan-$potongan_harga_enam_bulan;
            $checkout['paketEnamBulan'] = $harga_enam_bulan_diskon/6;
            $checkout['potonganPaketEnamBulan'] = $potongan_harga_enam_bulan;
            
            /* 12 BULAN PRICE */
            $harga_dua_belas_bulan = $diskonPaket['harga']*12;
            $potongan_harga_dua_belas_bulan = $harga_dua_belas_bulan*($checkout['diskonDuaBelasBulan']/100);
            $harga_dua_belas_bulan_diskon = $harga_dua_belas_bulan-$potongan_harga_dua_belas_bulan;
            $checkout['paketDuaBelasBulan'] = $harga_dua_belas_bulan_diskon/12;
            $checkout['potonganPaketDuaBelasBulan'] = $potongan_harga_dua_belas_bulan;
            
            /* 24 BULAN PRICE */
            $harga_dua_puluh_empat_bulan = $diskonPaket['harga']*24;
            $potongan_harga_dua_puluh_empat_bulan = $harga_dua_puluh_empat_bulan*($checkout['diskonDuaPuluhEmpatBulan']/100);
            $harga_dua_puluh_empat_bulan_diskon = $harga_dua_puluh_empat_bulan-$potongan_harga_dua_puluh_empat_bulan;
            $checkout['paketDuaPuluhEmpatBulan'] = $harga_dua_puluh_empat_bulan_diskon/24;
            $checkout['potonganPaketDuaPuluhEmpatBulan'] = $potongan_harga_dua_puluh_empat_bulan;
    
            $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif');
    
            /* Return view */
            return view('dashView.checkout', [
                'userLogin' => $userData,
                'fotoProfil' => $fotoProfil,
                'checkout' => $checkout,
                'checkPembelianPaket' => $checkPembelianPaket,
                'title' => 'Pembayaran Paket Premium'
            ]);

        }else{
            return redirect()->route('home')->with('errorselect', 'Jumlah karyawan melebihi batas paket Premium! ');
        }


    }

    public function businessPaket(){
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

        $is_process = $this->checkEmployed('Business', $userData->username);
        if($is_process){
            $diskonPaket = DiskonPaket::leftJoin('data_pakets','diskon_pakets.nama_paket_diskon','=','data_pakets.nama_paket')
                            ->select('diskon_pakets.*','data_pakets.harga_paket AS harga','data_pakets.nama_paket AS paket')
                            ->where('data_pakets.nama_paket', 'Business')
                            ->orderByDesc('data_pakets.nama_paket')
                            ->get();
    
            $diskonPaket = $diskonPaket[0];
    
            $checkout['namaPaket'] = $diskonPaket['paket'];
            $checkout['hargaNormal'] = $diskonPaket['harga'];
            $checkout['diskonTigaBulan'] = $diskonPaket['tiga_bulan'];
            $checkout['diskonEnamBulan'] = $diskonPaket['enam_bulan'];
            $checkout['diskonDuaBelasBulan'] = $diskonPaket['dua_belas_bulan'];
            $checkout['diskonDuaPuluhEmpatBulan'] = $diskonPaket['dua_puluh_empat_bulan'];
        
    
            /* 3 BULAN PRICE */
            $harga_tiga_bulan = $diskonPaket['harga']*3;
            $potongan_harga_tiga_bulan = $harga_tiga_bulan*($checkout['diskonTigaBulan']/100);
            $harga_tiga_bulan_diskon = $harga_tiga_bulan-$potongan_harga_tiga_bulan;
            $checkout['paketTigaBulan'] = $harga_tiga_bulan_diskon/3;
            $checkout['potonganPaketTigaBulan'] = $potongan_harga_tiga_bulan;
            
            /* 6 BULAN PRICE */
            $harga_enam_bulan = $diskonPaket['harga']*6;
            $potongan_harga_enam_bulan = $harga_enam_bulan*($checkout['diskonEnamBulan']/100);
            $harga_enam_bulan_diskon = $harga_enam_bulan-$potongan_harga_enam_bulan;
            $checkout['paketEnamBulan'] = $harga_enam_bulan_diskon/6;
            $checkout['potonganPaketEnamBulan'] = $potongan_harga_enam_bulan;
            
            /* 12 BULAN PRICE */
            $harga_dua_belas_bulan = $diskonPaket['harga']*12;
            $potongan_harga_dua_belas_bulan = $harga_dua_belas_bulan*($checkout['diskonDuaBelasBulan']/100);
            $harga_dua_belas_bulan_diskon = $harga_dua_belas_bulan-$potongan_harga_dua_belas_bulan;
            $checkout['paketDuaBelasBulan'] = $harga_dua_belas_bulan_diskon/12;
            $checkout['potonganPaketDuaBelasBulan'] = $potongan_harga_dua_belas_bulan;
            
            /* 24 BULAN PRICE */
            $harga_dua_puluh_empat_bulan = $diskonPaket['harga']*24;
            $potongan_harga_dua_puluh_empat_bulan = $harga_dua_puluh_empat_bulan*($checkout['diskonDuaPuluhEmpatBulan']/100);
            $harga_dua_puluh_empat_bulan_diskon = $harga_dua_puluh_empat_bulan-$potongan_harga_dua_puluh_empat_bulan;
            $checkout['paketDuaPuluhEmpatBulan'] = $harga_dua_puluh_empat_bulan_diskon/24;
            $checkout['potonganPaketDuaPuluhEmpatBulan'] = $potongan_harga_dua_puluh_empat_bulan;
    
            $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif');
    
            /* Return view */
            return view('dashView.checkout', [
                'userLogin' => $userData,
                'fotoProfil' => $fotoProfil,
                'checkout' => $checkout,
                'checkPembelianPaket' => $checkPembelianPaket,
                'title' => 'Pembayaran Paket Businss'
            ]);
        }else{
            return redirect()->route('home')->with('errorselect', 'Jumlah karyawan melebihi batas paket Business! ');
        }

    }

    /**
     * post the checout
     */
    public function checkoutPost(Request $request){
        /* User Login */
        $userData = Auth::user();
        /* data toko user */
        $InformationStore = InformationStore::select("id_store")
                            ->where("username_owner", $userData->username)
                            ->get();
        /* get first data */
        $InformationStore = $InformationStore[0];
        /* get id store */
        $id_store = $InformationStore->id_store; // db input
        /* get pake name form */
        $namaPaket = $request->paketLangganan; // db input

        $diskonAndHargaPaket = DiskonPaket::leftJoin('data_pakets','diskon_pakets.nama_paket_diskon','=','data_pakets.nama_paket')
                            ->select('diskon_pakets.*','data_pakets.harga_paket AS harga')
                            ->where('data_pakets.nama_paket', $namaPaket)
                            ->get();
        $checkPaket = $diskonAndHargaPaket->count() > 0 ? false : true;
        if($checkPaket){
            return redirect()->route("home")->with("alert","gagal");
        }
        /* get first data */
        $diskonAndHargaPaket = $diskonAndHargaPaket[0];
        $hargaPerbulan = $diskonAndHargaPaket->harga; // db input
        $totalHargaPembelian = $hargaPerbulan*$request->durasi_paket;
        
        $arrayDuration = array(
                            "3" => "tiga_bulan",
                            "6" => "enam_bulan",
                            "12" => "dua_belas_bulan",
                            "24" => "dua_puluh_empat_bulan",
                        );
        $diskon = 0; // db input
        $potongan = 0;
        foreach($arrayDuration as $key => $val){
            if($key == $request->durasi_paket){
                $diskon = $diskonAndHargaPaket[$val]; // db input
                $potongan = $totalHargaPembelian*($diskon/100);
                break;
            }
        }
        $totalWithDiskon = $totalHargaPembelian-$potongan;
        $ppn = $totalWithDiskon*0.11; // db input
        $total = $totalWithDiskon+$ppn; // db input
        $jangkaWaktu = $request->durasi_paket . " Bulan"; // db input 

        /* UTC datetime now in milisecond */
        $dateTimeNow = round(microtime(true) * 1000); // db input

        $pembelianPaket = new pembelianPaket();
        $pembelianPaket->id_store = $id_store;
        $pembelianPaket->paket = $namaPaket;
        $pembelianPaket->jangka_waktu = $jangkaWaktu;
        $pembelianPaket->harga_normal = $hargaPerbulan;
        $pembelianPaket->diskon = $diskon;
        $pembelianPaket->ppn = $ppn;
        $pembelianPaket->total_pembayaran = $total;
        $pembelianPaket->order_at = $dateTimeNow;
        $pembelianPaket->save();
        return redirect()->route("home")->with("success","berhasil");
    }

    public function checkEmployed($paket, $username){
        $fiturPaket = FiturPaket::select('nama_fitur_paket','Premium','Business')->where('nama_fitur_paket', 'Karyawan')->get();
        $max = $paket == 'Premium' ? $fiturPaket[0]->Premium : $fiturPaket[0]->Business;

        $informationStore = InformationStore::where("username_owner", $username)->get();
        $id_store = $informationStore[0]->id_store;

        $dataEmploye = EmployedOwner::where('id_store', $id_store)
                    ->where('status', 'Aktif')
                    ->get();


        return $dataEmploye->count() <= $max ? true : false;
    }

}
