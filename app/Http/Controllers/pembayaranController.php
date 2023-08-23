<?php

namespace App\Http\Controllers;

use App\Models\DiskonPaket;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
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

        /* Return view */
        return view('dashView.checkout', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'checkout' => $checkout,
            'title' => 'Pembayaran Paket Premium'
        ]);
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

        /* Return view */
        return view('dashView.checkout', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'checkout' => $checkout,
            'title' => 'Pembayaran Paket Businss'
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
