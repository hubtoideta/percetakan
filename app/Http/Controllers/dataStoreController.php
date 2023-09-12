<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformationStore;
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


    public function dbData($page, $namaToko = ""){
        if($namaToko == ""){
            $data = InformationStore::leftJoin('pembelian_pakets AS pp', function($join){
                $join->on('information_stores.id_store','=','pp.id_store')
                ->whereRaw('pp.code_pembelian = (SELECT code_pembelian FROM pembelian_pakets WHERE id_store = information_stores.id_store ORDER BY order_at DESC LIMIT 1)');
            })->select(
                'information_stores.username_owner AS owner',
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
