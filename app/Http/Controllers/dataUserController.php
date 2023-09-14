<?php

namespace App\Http\Controllers;

use App\pageLink;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class dataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $cateogryUser){
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
        $name = $request->query("nama");
        return view('dashView.pengguna', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'data' => $this->dbData($cateogryUser, $page, $name),
            'name' => $name,
            'slugg' => $cateogryUser,
            'title' => 'Data Pengguna - ' . ucfirst($cateogryUser)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function findData(Request $request, $cateogryUser){
        // /* User Login */
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
        $name = $request->name;
        return view('dashView.pengguna', [
            'userLogin' => $userData,
            'fotoProfil' => $fotoProfil,
            'data' => $this->dbData($cateogryUser, $page, $name),
            'name' => $name,
            'slugg' => $cateogryUser,
            'title' => 'Data Pengguna - ' . ucfirst($cateogryUser)
        ]);
    }

    public function updatePassword(Request $request, $cateogryUser){
        $pass = Hash::make(Str::of($request->new_password)->trim());
        
        User::where('username', $request->username)
            ->update([
                'password' => $pass
            ]);

        return redirect('pengguna/'. $cateogryUser);
    }
    
    public function dbData($cateogryUser, $page, $nama = ""){
        if($nama == ""){
            $data = User::leftJoin('profile_users','users.username','=','profile_users.username')
                        ->select(
                            'users.username AS username',
                            'users.email AS email',
                            'profile_users.photo_profile AS foto',
                            'profile_users.first_name AS first_name',
                            'profile_users.second_name AS second_name',
                            'profile_users.contact AS no_telpn',
                        )
                        ->where('users.category',ucfirst($cateogryUser))
                        ->orderBy('users.username')
                        ->paginate(perPage: 5, page: $page);
        }else{
            $data = User::leftJoin('profile_users','users.username','=','profile_users.username')
                        ->select(
                            'users.username AS username',
                            'users.email AS email',
                            'profile_users.photo_profile AS foto',
                            'profile_users.first_name AS first_name',
                            'profile_users.second_name AS second_name',
                            'profile_users.contact AS no_telpn',
                        )
                        ->where('users.category',ucfirst($cateogryUser))
                        ->where(function ($query) use ($nama){
                            $query->where('users.username','like','%'.$nama.'%')
                                ->orWhere('users.email','like','%'.$nama.'%');
                        })
                        ->orderBy('users.username')
                        ->paginate(perPage: 5, page: $page);
            $data->appends('nama', $nama);
        }
        $pageLink = new pageLink();

        $result['url'] = $pageLink->generate($data, $page);

        $result['items'] = $data->items();

        return $result;
    }
}
