<?php

namespace App\Http\Controllers;

use App\Models\kursiM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\LogM;
use PDF;

class kursiR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Data Kursi'
        ]);
        $subtittle = "halaman kursi";
        $kursi = kursiM::all();
        return view('kursi.kursi', compact('kursi', 'subtittle', 'log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Tambah Data Kursi'
        ]);
        $subtittle = "halaman tambah kursi";
        $kursi = kursiM::all();
        return view('kursi.kursi_create', compact('kursi', 'subtittle', 'log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mnambahkan Data Kursi'
        ]);

        $request->validate([
            'kode_kursi' => 'required',
        ]);

        $studio = new kursiM([
            'kode_kursi' => $request->kode_kursi,
        ]);
        $studio->save();

        return redirect()->route('kursi.index')->with('success', 'kursi Berhasil Ditambah', compact('log'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Edit Data Kursi'
        ]);
        $subtittle = "halaman edit kursi";
        $kursi = kursiM::find($id);
        return view('kursi.kursi_edit', compact('kursi', 'subtittle', 'log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kursi' => 'required',
        ]);

        $kursi = kursiM::find($id);
        $kursi->kode_kursi = $request->input('kode_kursi');
        $kursi->update();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Memperbaharui Data Kursi'
        ]);

        return redirect()->route('kursi.index')->with('success', 'Data kursi Berhasil Diedit', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Kursi'
        ]);

        kursiM::where('id',$id)->delete();
        return redirect()->route('kursi.index')->with('success', 'kursi Berhasil Dihapus', compact('log'));
    }
    public function reset($id)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Kursi'
        ]);
    
        $kursi = kursiM::find($id);
    
        // Periksa apakah kursi ditemukan
        if (!$kursi) {
            return redirect()->route('kursi.index')->with('error', 'Kursi tidak ditemukan');
        }
    
        // Ubah status kursi menjadi 'free'
        $kursi->status = 'free';
        $kursi->save();
    
        return redirect()->route('kursi.index')->with('success', 'Status kursi berhasil direset', compact('log', 'kursi'));
    }
    // public function resetAllStatus()
    // {
    //     // Ubah status semua kursi yang memiliki status 'booked'
    //     KursiM::where('status', 'booked')->update(['status' => 'free']);

    //     // Buat log atau pesan sukses jika diperlukan
    //     $log = LogM::create([
    //         'id_user' => Auth::user()->id,
    //         'activity' => 'User Mereset Semua Status Kursi'
    //     ]);

    //     return redirect()->route('kursi.index')->with('success', 'Semua status kursi berhasil direset', compact('log'));
    // }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data Kursi'
        ]);
        $kursi = kursiM::all();
        $pdf = PDF::loadview('kursi/kursi_pdf', ['kursi' => $kursi]);
        return $pdf->stream('kursi.pdf', compact('log'));
    }
}
