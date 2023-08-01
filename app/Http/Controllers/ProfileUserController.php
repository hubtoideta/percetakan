<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $userData = Auth::user();
        return view('dashView.profile', [
            'userLogin' => $userData,
            'title' => 'Profil'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileUser $profileUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileUser $profileUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileUser $profileUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileUser $profileUser)
    {
        //
    }
}
