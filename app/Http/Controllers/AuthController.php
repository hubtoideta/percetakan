<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password as PasswordReseFuct;

class AuthController extends Controller
{   
    /* VIEW LOGIN */
    public function loginViewPage(){
        return view('authView.login', [
            'title' => 'Masuk'
        ]);
    }
    /* VIEW LOGIN POST */
    public function loginPost(Request $request){
        $email_or_username = preg_replace('/\s+/','', Str::lower(Str::of($request->EmailOrUsername)->trim()));

        $checkWithEmail = [
            'email' => $email_or_username,
            'password' => $request->password
        ];
        if(Auth::attempt($checkWithEmail)){
            return redirect()->route('home')->with('success', 'Login Berhasil');
        }else{
            $checkWithUsername = [
                'username' => $email_or_username,
                'password' => $request->password
            ];
            if(Auth::attempt($checkWithUsername)){
                return redirect()->route('home')->with('success', 'Login Berhasil');
            }else{
                return back()->with('error', 'Login Gagal! Periksa Username / Email dan Password');
            }
        }
    }


    /* VIEW REGIS */
    public function registrasiViewPage(){
        return view('authView.registrasi', [
            'title' => 'Daftar'
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
        return redirect()->route('login')->with('success', 'Register Berhasil, Silahkan Login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function lupaPasswordViewPage(){
        return view('authView.lupa-password', [
            'title' => 'Lupa Password'
        ]);
    }

    public function lupaPasswordPost(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = PasswordReseFuct::sendResetLink(
            $request->only('email')
        );

        return $status === PasswordReseFuct::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['emails' => __($status)]);
    }

    public function passwordResetViewPage(string $token){
        return view('authView.reset-password', ['token' => $token, 'title' => 'Reset Password']);
    }

    public function passwordResetPost(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()]
        ]);

        $status = PasswordReseFuct::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === PasswordReseFuct::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['emails' => [__($status)]]);
    }

}
