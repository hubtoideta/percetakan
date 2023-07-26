<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{   
    /* VIEW LOGIN */
    public function loginViewPage(){
        return view('authView.login', [
            'title' => 'Masuk'
        ]);
    }
    /* VIEW REGIS POST */
    public function registrasiPost(Request $request){
        $request->validate([
            'username' => 'required|max:10|unique:users|lowercase',
            'email' => 'required|email|unique:users|lowercase',
            'password' => ['required', 'confirmed', Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'toc' => 'accepted'
        ]);

        $userDB = new User();

        $userDB->username = preg_replace('/\s+/','', Str::lower(Str::of($request->username)->trim()));
        $userDB->email = preg_replace('/\s+/','', Str::lower(Str::of($request->email)->trim()));
        $userDB->category = $request->account_type;
        $userDB->password = Hash::make($request->password);

        $userDB->save();
        return redirect(route('login'))->with('success', 'Register Berhasil, Silahkan Login');
    }
    /* VIEW REGIS */
    public function registrasiViewPage(){
        return view('authView.registrasi', [
            'title' => 'Daftar'
        ]);
    }


}
