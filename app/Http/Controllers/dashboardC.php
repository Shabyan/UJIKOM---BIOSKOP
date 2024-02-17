<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductM;
use App\Models\transactionM;
use App\Models\User;

class dashboardC extends Controller
{
    public function index()
    {
        $totaluser = User::count();
        $totalproduct = ProductM::count();
        $totaltransaction = TransactionM::count();
        $totaluangbayar = DB::table('transaction')
            ->sum('uang_bayar');
        $subtittle = "Dashboard";
        return view('dashboard', compact('totaluser','totaltransaction','totalproduct','totaluangbayar', 'subtittle'));
    }
}
