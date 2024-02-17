<?php

namespace App\Http\Controllers;

use App\Models\logM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class logC extends Controller
{
    public function index(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Log'
        ]);

        $data = LogM::select('users.*', 'log.*', 'users.id AS id_usr')->join('users', 'users.id', '=', 'log.id_user', )->orderBy('log.created_at', 'desc')->get();       
        $subtittle = "Daftar Aktivitas";
        return view('main/log', compact('subtittle', 'data'));
    }
}
