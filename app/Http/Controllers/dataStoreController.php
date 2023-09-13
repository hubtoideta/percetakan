<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformationStore;
use App\Models\pembelianPaket;
use App\Models\ProfileUser;
use App\pageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;

class dataStoreController extends Controller{

    public function index(Request $request){
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
        $page = $request->query("page") == "" ? 1 : $request->query("page");
        $nameStore = $request->query("toko");
        return view('dashView.data_toko', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'data' => $this->dbData($page, $nameStore),
            'name' => $nameStore,
            'title' => 'Data Toko'
        ]);
    }

    public function findData(Request $request){
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
        $page = $request->query("page") == "" ? 1 : $request->query("page");
        $nameStore = $request->name;
        return view('dashView.data_toko', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'data' => $this->dbData($page, $nameStore),
            'name' => $nameStore,
            'title' => 'Data Toko'
        ]);
    }

    public function update(Request $request, $act){
        $id_store = $request->id_store;

        if($act == 'matikan'){
            pembelianPaket::where('id_store', $id_store)
                            ->where('status_paket', 'Aktif')
                            ->orderByDesc('order_at')
                            ->limit(1)
                            ->update([
                                'non_aktif_at' => round(microtime(true) * 1000),
                                'status_paket' => 'Tidak Aktif',
                            ]);
        }elseif($act == 'aktifkan'){
            $timeNonAktif = $this->getNonAktifAt($id_store)->non_aktif_at;
            $timeNow = round(microtime(true) * 1000);
            $durasi_non_aktif = $timeNow-$timeNonAktif;
            $update_time_end = $this->getNonAktifAt($id_store)->end_paket_at+$durasi_non_aktif;
            pembelianPaket::where('id_store', $id_store)
                            ->where('status_paket', 'Tidak Aktif')
                            ->orderByDesc('order_at')
                            ->limit(1)
                            ->update([
                                'non_aktif_at' => 0,
                                'status_paket' => 'Aktif',
                                'end_paket_at' => $update_time_end,
                            ]);
        }else{
            $pembelianPaket = new pembelianPaket();
            $pembelianPaket->id_store = $id_store;
            $pembelianPaket->paket = 'Premium';
            $pembelianPaket->jangka_waktu = '14 Hari';
            $pembelianPaket->harga_normal = 0;
            $pembelianPaket->diskon = 0;
            $pembelianPaket->ppn = 0;
            $pembelianPaket->total_pembayaran = 0;
            $pembelianPaket->status_order = 'Diterima';
            $pembelianPaket->status_paket = 'Aktif';
            $pembelianPaket->order_at = round(microtime(true) * 1000);
            $pembelianPaket->confirm_at = round(microtime(true) * 1000);
            $pembelianPaket->start_paket_at = round(microtime(true) * 1000);
            $pembelianPaket->end_paket_at = (14*24*60*60*1000)+round(microtime(true) * 1000);
            $pembelianPaket->save();
        }

        return redirect()->route('dataToko');

        // return var_dump($act, $id_store);
    }

    public function getNonAktifAt($id_store){
        $data = InformationStore::leftJoin('pembelian_pakets AS pp', function($join){
            $join->on('information_stores.id_store','=','pp.id_store')
            ->whereRaw('pp.code_pembelian = (SELECT code_pembelian FROM pembelian_pakets WHERE id_store = information_stores.id_store ORDER BY order_at DESC LIMIT 1)');
        })->select(
            'pp.non_aktif_at AS non_aktif_at',
            'pp.end_paket_at AS end_paket_at'
        )
        ->where('information_stores.id_store', $id_store)
        ->where('pp.status_paket', 'Tidak Aktif')
        ->get();

        return $data[0];
    }

    public function dbData($page, $namaToko = ""){
        if($namaToko == ""){
            $data = InformationStore::leftJoin('pembelian_pakets AS pp', function($join){
                $join->on('information_stores.id_store','=','pp.id_store')
                ->whereRaw('pp.code_pembelian = (SELECT code_pembelian FROM pembelian_pakets WHERE id_store = information_stores.id_store ORDER BY order_at DESC LIMIT 1)');
            })->select(
                'information_stores.username_owner AS owner',
                'information_stores.id_store AS code',
                'information_stores.logo AS logo',
                'information_stores.store_name AS nama_toko',
                'information_stores.store_email AS email',
                'information_stores.contact AS contact',
                'pp.paket AS paket',
                'pp.jangka_waktu AS durasi',
                'pp.status_paket AS status',
                'pp.start_paket_at AS dari',
                'pp.end_paket_at AS sampai'
            )->orderBy('information_stores.store_name')
            ->paginate(perPage: 10, page: $page);
        }else{
            $data = InformationStore::leftJoin('pembelian_pakets AS pp', function($join){
                $join->on('information_stores.id_store','=','pp.id_store')
                ->whereRaw('pp.code_pembelian = (SELECT code_pembelian FROM pembelian_pakets WHERE id_store = information_stores.id_store ORDER BY order_at DESC LIMIT 1)');
            })->select(
                'information_stores.username_owner AS owner',
                'information_stores.id_store AS code',
                'information_stores.logo AS logo',
                'information_stores.store_name AS nama_toko',
                'information_stores.store_email AS email',
                'information_stores.contact AS contact',
                'pp.paket AS paket',
                'pp.jangka_waktu AS durasi',
                'pp.status_paket AS status',
                'pp.start_paket_at AS dari',
                'pp.end_paket_at AS sampai'
            )->where('information_stores.store_name','like', '%'.$namaToko.'%')
            ->orWhere('information_stores.username_owner','like', '%'.$namaToko.'%')
            ->orderBy('information_stores.store_name')
            ->paginate(perPage: 10, page: $page);
        }
        $data->appends('toko', $namaToko);

        $pageLink = new pageLink();

        $result['url'] = $pageLink->generate($data, $page);

        $result['items'] = $data->items();

        return $result;
    }
}
