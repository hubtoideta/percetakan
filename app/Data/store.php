<?php

namespace App\Data;

use App\Models\FiturPaket;
use App\Models\InformationStore;
use App\Models\pembelianPaket;

class store{

    public function getDataWithOwner($userLogin){
        $data = InformationStore::select('id_store')
                                            ->where('username_owner', $userLogin)
                                            ->get();
        $result['store'] = $data;
        $result['expired'] = $this->getExpired($data[0]->id_store);
        return $result;
    }

    public function getDataWithEmploye(){

    }

    protected function getExpired($id_store){
        $data = pembelianPaket::where("id_store", $id_store)
                                ->orderByDesc("order_at")
                                ->limit(1)
                                ->get();
        if($data[0]->status_paket == 'Aktif'){
            $end_paket = $data[0]->end_paket_at;
            $date_now = round(microtime(true) * 1000);
            // matikan paket
            if($end_paket < $date_now){
                pembelianPaket::where("id_store", $id_store)
                                ->update([
                                    'status_paket' => 'Tidak Aktif'
                                ]);
                $data = pembelianPaket::where("id_store", $id_store)
                                    ->orderByDesc("order_at")
                                    ->limit(1)
                                    ->get();
            }
        }
        return $data;
    }

    public function fiturPaket($nama_fitur){
        $data = FiturPaket::where('nama_fitur_paket', $nama_fitur)
                        ->select('Premium','Business')
                        ->get();

        return $data;
    }


}
