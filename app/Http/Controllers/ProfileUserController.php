<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        /* Login Auth */
        $userData = Auth::user();
        $userEmail = $userData->email;
        $profileUser = ProfileUser::select('photo_profile', 'first_name', 'second_name', 'contact')->where('email', $userEmail)->first();
        $totalData = ProfileUser::count();
        
        if($totalData > 0){
            $fotoProfil = $profileUser->photo_profile;
        }else{
            $fotoProfil = 'none';
        }

        return view('dashView.profile', [
            'profileUser' => $profileUser,
            'fotoProfil' => $fotoProfil,
            'totalData' => $totalData,
            'userLogin' => $userData,
            'title' => 'Profil'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $userEmail = $userData->email;
        $request->validate(
            [
                'photo_profile' => 'mimes:jpg,png,jpeg|max:2048',
                'first_name' => 'required|max:12',
                'second_name' => 'required|max:12',
                'contact' => 'required|numeric|digits_between:8,15',
            ], 
            [
                'photo_profile.mimes' => 'foto profile harus berformat jpg, png atau jpeg.',
                'photo_profile.max' => 'ukuran file foto profil melebihi 2048kb.',
                
                'first_name.required' => 'Kolom nama depan wajib diisi.',
                'first_name.max' => 'Kolom nama depan tidak boleh lebih dari 12 karakter.',
                
                'second_name.required' => 'Kolom nama belakang wajib diisi.',
                'second_name.max' => 'Kolom nama belakang tidak boleh lebih dari 12 karakter.',
                
                'contact.required' => 'Kolom nomor telepon wajib diisi.',
                'contact.numeric' => 'Kolom nomor telepon harus berupa angka.',
                'contact.digits_between' => 'Kolom nomor telepon harus terdiri dari 8 hingga 15 digit.',
            ]
        );
        $file_name = 'none';
        /* jika file pp di upload */
        if ($request->hasFile('photo_profile')) {
            $file_name = time() . '_' . $userData->username . '.' . $request->photo_profile->extension();
            $request->photo_profile->move(public_path('assets/media/profile'), $file_name);
        }

        $userProfile = new ProfileUser();

        $userProfile->email = $userEmail;
        $userProfile->photo_profile = $file_name;
        $userProfile->first_name = ucwords(Str::of($request->first_name)->trim());
        $userProfile->second_name = ucwords(Str::of($request->second_name)->trim());
        $userProfile->contact = processPhoneNumber(Str::of($request->contact)->trim());

        $userProfile->save();
        return redirect()->route('profile')->with('success', 'Data Berhasil diubah.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $userEmail = $userData->email;
        $profileUser = ProfileUser::select('photo_profile')->where('email', $userEmail)->first();
        $oldPhotoProfile = $profileUser->photo_profile;

        $request->validate(
            [
                'photo_profile' => 'mimes:jpg,png,jpeg|max:2048',
                'first_name' => 'required|max:12',
                'second_name' => 'required|max:12',
                'contact' => 'required|numeric|digits_between:8,15',
            ], 
            [
                'photo_profile.mimes' => 'foto profile harus berformat jpg, png atau jpeg.',
                'photo_profile.max' => 'ukuran file foto profil melebihi 2048kb.',
                
                'first_name.required' => 'Kolom nama depan wajib diisi.',
                'first_name.max' => 'Kolom nama depan tidak boleh lebih dari 12 karakter.',
                
                'second_name.required' => 'Kolom nama belakang wajib diisi.',
                'second_name.max' => 'Kolom nama belakang tidak boleh lebih dari 12 karakter.',
                
                'contact.required' => 'Kolom nomor telepon wajib diisi.',
                'contact.numeric' => 'Kolom nomor telepon harus berupa angka.',
                'contact.digits_between' => 'Kolom nomor telepon harus terdiri dari 8 hingga 15 digit.',
            ]
        );

        
        /* jika file pp di upload */
        if ($request->hasFile('photo_profile')) {
            $file_name = time() . '_' . $userData->username . '.' . $request->photo_profile->extension();
            $request->photo_profile->move(public_path('assets/media/profile'), $file_name);
            /* delete file old pp */
            if($oldPhotoProfile != 'none'){
                if(File::exists(public_path('assets/media/profile/' . $oldPhotoProfile))){
                    File::delete(public_path('assets/media/profile/' . $oldPhotoProfile));
                }
            }
        }else{
            /* jika pp di remove */
            if($request->avatar_remove == '1'){
                /* delete file old pp */
                if($oldPhotoProfile != 'none'){
                    if(File::exists(public_path('assets/media/profile/' . $oldPhotoProfile))){
                        File::delete(public_path('assets/media/profile/' . $oldPhotoProfile));
                    }
                }
                $file_name = 'none';
            }else{
                $file_name = $oldPhotoProfile;
            }
        }

        $contact = processPhoneNumber(Str::of($request->contact)->trim());

        ProfileUser::where('email', $userEmail)->update([
            'photo_profile' => $file_name,
            'first_name' => ucwords(Str::of($request->first_name)->trim()),
            'second_name' => ucwords(Str::of($request->second_name)->trim()),
            'contact' => $contact
        ]);
        return redirect()->route('profile')->with('success', 'Data Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileUser $profileUser)
    {
        //
    }
}
