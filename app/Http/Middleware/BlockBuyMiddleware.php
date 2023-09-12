<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\pembelianPaket;
use App\Models\InformationStore;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlockBuyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userData = Auth::user();
        $informationStore = InformationStore::where("username_owner", $userData->username)->get();
        if($informationStore->count() > 0){
            $id_store = $informationStore[0]->id_store;
            $checkPembelianPaket = pembelianPaket::where("id_store", $id_store)
                    ->orderByDesc("order_at")
                    ->limit(1)
                    ->get();
            if($checkPembelianPaket->count() == 0){
                return $next($request);
            }else{
                if($checkPembelianPaket[0]->status_order == "Ditolak" || ($checkPembelianPaket[0]->status_order == 'Diterima' && $checkPembelianPaket[0]->status_paket == 'Tidak Aktif')){
                    return $next($request);
                }else{
                    return redirect()->route('home');
                }
            }
        }else{
            return redirect()->route('kelolah-toko');
        }
    }
}
