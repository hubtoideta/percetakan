<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Data\store;
use App\Models\EmployedOwner;
use App\Models\User;
use App\pageLink;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class dataEmployedController extends Controller
{
    public function index(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $username = $userData->username;
        // DATA INFOMASI TOKO
        $dataStore = new store();
        // ID TOKO
        $id_store = $dataStore->getDataWithOwner($username)['store'][0]->id_store;
        // CHECK STATUS PAKET DAN AMBIL DATA STATUS PAKET TOKO
        $getExpired = $dataStore->getDataWithOwner($username)['expired'];
        if($getExpired[0]->status_paket == 'Aktif'){
            $profileUser = ProfileUser::select('photo_profile')->find($username);
            $totalData = $profileUser ? $profileUser->count() : 0;

            if($totalData > 0){
                $fotoProfil = $profileUser->photo_profile;
            }else{
                $fotoProfil = 'none';
            }

            $roleOpt = array('Administrasi','Desainer','Produksi','Pemasang');

            $page = $request->query("page") == "" ? 1 : $request->query("page");

            /* Return view */
            return view('dashView.karyawan', [
                'userLogin' => $userData,
                'fotoProfil' => $fotoProfil,
                'checkPembelianPaket' => $getExpired,
                'data' => $this->dbData($id_store, $page),
                'title' => 'Data Karyawan',
                'roleOpt' => $roleOpt,
            ]);

        }else{
            return redirect()->route('home');
        }
    }

    public function create(Request $request){
        /* Login Auth */
        $userData = Auth::user();
        $username = $userData->username;
        // DATA INFOMASI TOKO
        $dataStore = new store();
        // ID TOKO
        $id_store = $dataStore->getDataWithOwner($username)['store'][0]->id_store;
        // CHECK STATUS PAKET DAN AMBIL DATA STATUS PAKET TOKO
        $getExpired = $dataStore->getDataWithOwner($username)['expired'];
        if($getExpired[0]->status_paket == 'Aktif'){
            // paket langganan
            $paket = $getExpired[0]->paket;
            // maksimal karyawan berdasarkan paket langganan
            $maximal_employed = $paket == 'Premium' ? $dataStore->fiturPaket('Karyawan')[0]->Premium : $dataStore->fiturPaket('Karyawan')[0]->Business;
            $total_employed = EmployedOwner::where('employed_owners.id_store', $id_store)->where('status', 'Aktif')->count();
            if($total_employed < $maximal_employed){
                $request->validate(
                    [
                        'roleEmployed' => 'required',
                        'username' => 'required|max:10|unique:users|lowercase',
                        'email' => 'required|email|unique:users|lowercase',
                        'password' => ['required', 'confirmed', Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()]
                    ],
                    [
                        'photo_profile.required' => 'Pilih Role Karyawan.',
                    ]

                );

                // save data user for login
                $userDB = new User();

                $userDB->username = preg_replace('/\s+/','', Str::lower(Str::of($request->username)->trim()));
                $userDB->email = preg_replace('/\s+/','', Str::lower(Str::of($request->email)->trim()));
                $userDB->category = 'Employed';
                $userDB->password = Hash::make(Str::of($request->password)->trim());

                $userDB->save();

                $employedStore = new EmployedOwner();

                $employedStore->id_store = $id_store;
                $employedStore->username = preg_replace('/\s+/','', Str::lower(Str::of($request->username)->trim()));
                $employedStore->role = $request->roleEmployed;

                $employedStore->save();
                return redirect()->route('dataEmploye')->with('success', 'Data karyawan berhasil ditambah.');

            }else{
                return redirect()->route('dataEmploye')->with('error', 'Anda mencapai batas maksimal perekrutan karyawan! maksimal ' . $maximal_employed . ' Karyawan');
            }
        }else{
            return redirect()->route('home');

        }
    }

    public function updateStatus(Request $request){
         /* Login Auth */
        $userData = Auth::user();
        $username = $userData->username;
        // DATA INFOMASI TOKO
        $dataStore = new store();
        // ID TOKO
        $id_store = $dataStore->getDataWithOwner($username)['store'][0]->id_store;
        // CHECK STATUS PAKET DAN AMBIL DATA STATUS PAKET TOKO
        $getExpired = $dataStore->getDataWithOwner($username)['expired'];
        if($getExpired[0]->status_paket == 'Aktif'){
            $usernameInput = $request->username;
            $statusInput = $request->status;
            $updateStatus = 0;
            if($statusInput == 'Aktif'){
                $updateStatus = EmployedOwner::where('id_store', $id_store)
                                            ->where('username', $usernameInput)
                                            ->update([
                                                'status' => 'Tidak Aktif'
                                            ]);
            }elseif($statusInput == 'Tidak Aktif'){
                $updateStatus = EmployedOwner::where('id_store', $id_store)
                                            ->where('username', $usernameInput)
                                            ->update([
                                                'status' => 'Aktif'
                                            ]);
            }
            
            if($updateStatus > 0){
                return redirect()->route('dataEmploye')->with('success', 'Data berhasil diubah.');
            }else{
                return redirect()->route('dataEmploye')->with('error', 'Request ditolak');
            }
        }else{
            return redirect()->route('home');

        }

    }

    public function dbData($id_store, $page){
        $data = EmployedOwner::leftJoin('users','employed_owners.username','=','users.username')
                            ->leftJoin('profile_users','employed_owners.username','=','profile_users.username')
                            ->select(
                                'users.username AS username',
                                'users.email AS email',
                                'profile_users.photo_profile AS foto',
                                'profile_users.first_name AS first_name',
                                'profile_users.second_name AS second_name',
                                'profile_users.contact AS no_telpn',
                                'employed_owners.role AS role',
                                'employed_owners.status AS status',
                            )
                            ->where('employed_owners.id_store', $id_store)
                            ->orderBy('users.username')
                            ->paginate(perPage: 5, page: $page);

        $pageLink = new pageLink();

        $result['url'] = $pageLink->generate($data, $page);

        $result['items'] = $data->items();

        $result['total'] = $data->total();

        return $result;
    }
}
