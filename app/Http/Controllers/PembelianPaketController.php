<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\pembelianPaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class PembelianPaketController extends Controller
{
    public function dbPembelianPaket($page){
        $data = pembelianPaket::leftJoin('information_stores','pembelian_pakets.id_store','=','information_stores.id_store')
                            ->select('information_stores.id_store AS store_code','information_stores.store_name AS percetakan','pembelian_pakets.*')
                            ->paginate(perPage: 10, page: $page);

        $result['items'] = $data->items();
        $result['url'] = $data->links('pagination::bootstrap-5');

        return $result;
    }
    /**
     * Display a listing of the resource.
     */
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

        if($userData->category == "Developer"){
            /* aksi */
            if($request->query("id") != "" && $request->query("confirm") != ""){
                $idOrder = $request->query("id");
                $aksi = $request->query("confirm");
                $checkData = pembelianPaket::select('jangka_waktu AS durasi','status_order AS status')
                                            ->find($idOrder);
                                            
                if($checkData){
                    /* konfirmasi pembelian */
                    if($checkData['status'] == "Pending"){
                        $current_time_now = round(microtime(true) * 1000);
                        if($aksi == "terima"){
                            $duration = explode(" ",$checkData['durasi'])[0];
                            $duration_in_militime = $duration * 30 * 24 * 60 * 60 * 1000;
                            $current_time_expired = $current_time_now + $duration_in_militime;
                            pembelianPaket::find($idOrder)->update([
                                "status_order" => "Diterima",
                                "status_paket" => "Aktif",
                                "confirm_at" => $current_time_now,
                                "start_paket_at" => $current_time_now,
                                "end_paket_at" => $current_time_expired,
                            ]);
                            /* Return view */
                            return redirect()->route("pembelianPaket");
                        }elseif($aksi == "tolak"){
                            pembelianPaket::find($idOrder)->update([
                                "status_order" => "Ditolak",
                                "confirm_at" => $current_time_now,
                            ]);
                            /* Return view */
                            return redirect()->route("pembelianPaket");

                        }else{
                            /* Return view */
                            return redirect()->route("pembelianPaket");
                        }
                    }else{
                        /* Return view */
                        return redirect()->route("pembelianPaket");
                    }
                }else{
                    /* Return view */
                    return redirect()->route("pembelianPaket");
                }
                /* konfirm tolak/terima */
                // if($aksi == "terima" || $aksi == "tolak"){
                // }
            }else{
                $page = $request->query("page") == "" ? 1 : $request->query("page");
                /* Return view */
                return view('dashView.pembelian_paket', [
                    'userLogin' => $userData,
                    'fotoProfil' => $fotoProfil,
                    'data' => $this->dbPembelianPaket($page),
                    'title' => 'Pembelian Paket'
                ]);
            }
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
