<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        /* Login Auth */
        $userData = Auth::user();
        $username = $userData->username;
        $profileUser = ProfileUser::select('photo_profile', 'first_name', 'second_name', 'contact')->find($username);
        $totalData = $profileUser ? $profileUser->count() : 0;

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
        $username = $userData->username;
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

        $userProfile->username = $username;
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
        $username = $userData->username;
        $profileUser = ProfileUser::select('photo_profile')->find($username);
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
            }else{
                $file_name = $oldPhotoProfile;
            }
        }

        $contact = processPhoneNumber(Str::of($request->contact)->trim());

        ProfileUser::where('username', $username)->update([
            'photo_profile' => $file_name,
            'first_name' => ucwords(Str::of($request->first_name)->trim()),
            'second_name' => ucwords(Str::of($request->second_name)->trim()),
            'contact' => $contact
        ]);
        return redirect()->route('profile')->with('success', 'Data Berhasil diubah.');
    }

    public function updateEmail(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                    'lowercase',
                    Rule::unique('users')->ignore($userData->username, 'username'),
                ],
                'confirmemailpassword' => 'required|current_password',
            ],
            [
                'email.required' => 'Alamat email tidak boleh kosong.',
                'email.email' => 'Alamat email tidak sesuai format.',
                'email.unique' => 'Alamat email sudah terpakai.',
                'confirmemailpassword.required' => 'Password anda salah',
                'confirmemailpassword.current_password' => 'Password anda salah',
            ]
        );

        User::where('username', $userData->username)->update([
            'email' => preg_replace('/\s+/','', Str::lower(Str::of($request->email)->trim()))
        ]);
        return redirect()->route('profile')->with('successAccount', 'Email Berhasil diubah.');
    }

    public function updatePassword(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $request->validate(
            [
                'currentpassword' => 'required|current_password',
                'password' => [
                    'required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                ]
            ],
            [
                'currentpassword.required' => 'Password anda salah',
                'currentpassword.current_password' => 'Password anda salah',
                'password.required' => 'Password tidak boleh kosong.',
                'password.confirmed' => 'Password konfirmasi anda berbeda.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.mixed' => 'Password harus dikombinasikan dengan huruf besar dan kecil.',
                'password.numbers' => 'Password harus berisikan minimal satu angka.',
                'password.symbols' => 'Password harus berisikan minimal satu simbol.',
            ]
        );

        User::where('username', $userData->username)->update([
            'password' => Hash::make(Str::of($request->password)->trim())
        ]);
        return redirect()->route('profile')->with('successAccount', 'Password Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileUser $profileUser)
    {
        //
    }
}
