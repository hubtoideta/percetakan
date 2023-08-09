<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\InformationStore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $totalData = $profileUser->count();
    
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        $logo = "none";
        if($userData->category == "Owner"){
            $informationStore = InformationStore::where("username_owner", $userData->username)->get();
            if($informationStore->count() > 0){
                $informationStore = $informationStore[0];
                $logo = $informationStore->logo;
            }
        }

        return view('dashView.kelolah_toko', [
            'fotoProfil' => $fotoProfil,
            'totalData' => $totalData,
            'infoDataCount' => $informationStore->count(),
            'infoData' => $informationStore,
            'logo' => $logo,
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
            $file_name = time() . '_' . $request->store_name . '.' . $request->logoInput->extension();
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
    public function update(Request $request, InformationStore $informationStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformationStore $informationStore)
    {
        //
    }
}
