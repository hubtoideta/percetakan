<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\pembelianPaket;
use Illuminate\Validation\Rule;
use App\Models\InformationStore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InformationStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        /* Login Auth */
        $userData = Auth::user();
        $username = $userData->username;
        $profileUser = ProfileUser::select('photo_profile')->find($userData->username);
        $totalData = $profileUser ? $profileUser->count() : 0;
    
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        $logo = "none";
        $checkPembelianPaket = [];
        if($userData->category == "Owner"){
            $informationStore = InformationStore::where("username_owner", $userData->username)->get();
            if($informationStore->count() > 0){
                $informationStore = $informationStore[0];
                $logo = $informationStore->logo;
                $id_store = $informationStore->id_store;
                $checkPembelianPaket = pembelianPaket::where("id_store", $id_store)
                    ->orderByDesc("order_at")
                    ->limit(1)
                    ->get();
                if($checkPembelianPaket->count() == 0){
                    $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif');
                }
            }else{
                $checkPembelianPaket[] = array('status_paket' => 'Tidak Aktif');
            }
        }
        return view('dashView.kelolah_toko', [
            'fotoProfil' => $fotoProfil,
            'totalData' => $totalData,
            'infoDataCount' => $informationStore->count(),
            'infoData' => $informationStore,
            'logo' => $logo,
            'checkPembelianPaket' => $checkPembelianPaket,
            'userLogin' => $userData,
            'title' => 'Kelolah Toko'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        /* Login Auth */
        $userData = Auth::user();

        $request->validate(
            [
                'logoInput' => 'mimes:jpg,png,jpeg|max:2048',
                'store_name' => 'required|max:150||unique:information_stores',
                'store_email' => 'required|email|unique:information_stores|lowercase',
                'noTokoInput' => 'required|numeric|digits_between:8,15',
                'deskTokoInput' => 'required|max:150',
            ],
            [
                'logoInput.mimes' => 'logo harus berformat jpg, png atau jpeg.',
                'logoInput.max' => 'ukuran file logo melebihi 2048kb.',
                
                'store_name.required' => 'Kolom nama toko wajib diisi.',
                'store_name.unique' => 'nama toko sudah digunakan.',
                'store_name.max' => 'Kolom nama toko tidak boleh lebih dari 150 karakter.',
                
                'store_email.required' => 'Kolom email wajib diisi.',
                'store_email.email' => 'Alamat email tidak sesuai format.',
                'store_email.unique' => 'Email sudah digunakan.',

                'noTokoInput.required' => 'Kolom nomor telepon wajib diisi.',
                'noTokoInput.numeric' => 'Kolom nomor telepon harus berupa angka.',
                'noTokoInput.digits_between' => 'Kolom nomor telepon harus terdiri dari 8 hingga 15 digit.',
                
                'deskTokoInput.required' => 'Kolom deskripsi wajib diisi.',
                'deskTokoInput.max' => 'Kolom deskripsi tidak boleh lebih dari 150 karakter.',
            ]
        );
        $file_name = 'none';
        /* jika file pp di upload */
        if ($request->hasFile('logoInput')) {
            $file_name = time() . '_' . str_replace(" ","_",$request->store_name) . '.' . $request->logoInput->extension();
            $request->logoInput->move(public_path('assets/media/logo'), $file_name);

        }

        $informationStore = new InformationStore();

        $informationStore->username_owner = $userData->username;
        $informationStore->logo = $file_name;
        $informationStore->store_name = ucwords(Str::of($request->store_name)->trim());
        $informationStore->store_email = Str::lower(Str::of($request->store_email)->trim());
        $informationStore->contact = processPhoneNumber(Str::of($request->noTokoInput)->trim());
        $informationStore->deskripsi = $request->deskTokoInput;

        $informationStore->save();
        return redirect()->route('kelolah-toko')->with('success', 'Data Berhasil diubah.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){

        $informationStore = InformationStore::select("logo")->find($request->id_store);
        $oldLogoFile = $informationStore->logo;

        $request->validate(
            [
                'logoInput' => 'mimes:jpg,png,jpeg|max:2048',
                'store_name' => [
                    'required',
                    'max:150',
                    Rule::unique('information_stores')->ignore($request->id_store, 'id_store'),
                ],
                'store_email' => [
                    'required',
                    'email',
                    'lowercase',
                    Rule::unique('information_stores')->ignore($request->id_store, 'id_store'),
                ],
                'noTokoInput' => 'required|numeric|digits_between:8,15',
                'deskTokoInput' => 'required|max:150',
            ],
            [
                'logoInput.mimes' => 'logo harus berformat jpg, png atau jpeg.',
                'logoInput.max' => 'ukuran file logo melebihi 2048kb.',
                
                'store_name.required' => 'Kolom nama toko wajib diisi.',
                'store_name.unique' => 'nama toko sudah digunakan.',
                'store_name.max' => 'Kolom nama toko tidak boleh lebih dari 150 karakter.',
                
                'store_email.required' => 'Kolom email wajib diisi.',
                'store_email.email' => 'Alamat email tidak sesuai format.',
                'store_email.unique' => 'Email sudah digunakan.',

                'noTokoInput.required' => 'Kolom nomor telepon wajib diisi.',
                'noTokoInput.numeric' => 'Kolom nomor telepon harus berupa angka.',
                'noTokoInput.digits_between' => 'Kolom nomor telepon harus terdiri dari 8 hingga 15 digit.',
                
                'deskTokoInput.required' => 'Kolom deskripsi wajib diisi.',
                'deskTokoInput.max' => 'Kolom deskripsi tidak boleh lebih dari 150 karakter.',
            ]
        );
        $file_name = 'none';
        /* jika file pp di upload */
        if ($request->hasFile('logoInput')) {
            $file_name = time() . '_' . str_replace(" ","_",$request->store_name) . '.' . $request->logoInput->extension();
            $request->logoInput->move(public_path('assets/media/logo'), $file_name);
            /* delete file old pp */
            if($oldLogoFile != 'none'){
                if(File::exists(public_path('assets/media/logo/' . $oldLogoFile))){
                    File::delete(public_path('assets/media/logo/' . $oldLogoFile));
                }
            }
        }else{
            /* jika pp di remove */
            if($request->avatar_remove == '1'){
                /* delete file old pp */
                if($oldLogoFile != 'none'){
                    if(File::exists(public_path('assets/media/logo/' . $oldLogoFile))){
                        File::delete(public_path('assets/media/logo/' . $oldLogoFile));
                    }
                }
            }else{
                $file_name = $oldLogoFile;
            }
        }

        InformationStore::where('id_store', $request->id_store)->update([
            'logo' => $file_name,
            'store_name' => $request->store_name,
            'store_email' => $request->store_email,
            'contact' => $request->noTokoInput,
            'deskripsi' => $request->deskTokoInput,
        ]);
        return redirect()->route('kelolah-toko')->with('success', 'Data Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformationStore $informationStore)
    {
        //
    }
}
