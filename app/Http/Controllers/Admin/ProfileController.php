<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\RoleConstant;
use App\User;
use UxWeb\SweetAlert\SweetAlert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //kullanıcı profilini çekip gösterelim

        $user = auth()->user();
        $roles = RoleConstant::Roles();
        return view('backend.auth.profile', compact('user', 'roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'adi' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);

        User::find(auth()->user()->id)->update(['adi' => $request->adi, 'email' => $request->email, 'mobile' => $request->mobile, 'avatar' => $request->avatar]);
        return redirect()->route('admin.profile.index');
        alert()->success('Profil Başarıyla Güncellendi', 'Profil güncellendi');
    }
}