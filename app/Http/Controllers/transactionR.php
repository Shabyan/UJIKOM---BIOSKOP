<?php

namespace App\Http\Controllers;

use App\Models\kursiM;
use App\Models\studioM;
use Illuminate\Http\Request;
use App\Models\LogM;
use App\Models\productM;
use Illuminate\Support\Facades\Auth;
use App\Models\transactionM;
use PDF;

class transactionR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TransactionM = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'studio.*', 'transaction.id AS id_trans', 'transaction.created_at as tgl')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->join('studio', 'studio.id', '=', 'transaction.id_studio')
        ->orderBy('transaction.id', 'desc')->get();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman transaksi'
        ]);
        $subtittle = "halaman transaksi";
        return view('transaction.transaction', compact('TransactionM', 'subtittle', 'log'));

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
            'activity' => 'User Melihat Halaman transaksi'
        ]);
        $produk = productM::all();
        $kursi = kursiM::all();
        $studio = studioM::all();
        $subtittle = "halaman transaksi";
        return view('transaction.transaction_create', compact('studio', 'kursi', 'produk', 'subtittle', 'log'));
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
            'activity' => 'User melihat halaman transaksi'
        ]);

        
        $produk = productM::where("id", $request->input('id_produk'))->first();
        $kursi = kursiM::where("id", $request->input('id_kursi'))->first();
        $studio = studioM::where("id", $request->input('id_studio'))->first();

        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'id_kursi' => 'required',
            'id_studio' => 'required',
            'uang_bayar' => 'required'
        ]);
        $transaction = new TransactionM;
        $transaction -> nomor_unik = $request->input('nomor_unik');
        $transaction -> nama_pelanggan = $request->input('nama_pelanggan');
        $transaction -> id_produk = $request->input('id_produk');
        $transaction -> id_kursi = $request->input('id_kursi');
        $transaction -> id_studio = $request->input('id_studio');
        $transaction -> uang_bayar = $request->input('uang_bayar');
        $transaction -> uang_kembali = $request->input('uang_bayar') - $produk->harga_produk;
        $transaction->save();

        $kursi->status = 'booked';
        $kursi->save();


        return redirect()->route('transaction.index')->with('success', 'transaksi berhasil ditambahkan', compact('log'));

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
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User melihat halaman edit transaksi',
        ]);

        $subtittle = "Edit Product Transaction";
        $transaction = transactionM::find($id);
        $product = productM::all();
        $studio = studioM::all();
        $kursi = kursiM::all();
        return view('transaction.transaction_edit', compact('subtittle','product','transaction', 'studio', 'kursi'));

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
        $product = productM::where("id", $request->input('id_produk'))->first();
        $kursi = kursiM::where("id", $request->input('id_kursi'))->first();
        $studio = studioM::where("id", $request->input('id_studio'))->first();

        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'id_studio' => 'required',
            'id_kursi' => 'required',
            'uang_bayar' => 'required',
        ]);
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User mengedit data transaksi'
        ]);
        $transaction = transactionM::find($id);
        $transaction->nomor_unik = $request->input('nomor_unik');
        $transaction->nama_pelanggan = $request->input('nama_pelanggan');
        $transaction->id_produk = $request->input('id_produk');
        $transaction->id_studio = $request->input('id_studio');
        $transaction->id_kursi = $request->input('id_kursi');
        $transaction->uang_bayar = $request->input('uang_bayar');
        $transaction->save();
        // TransactionsM::create($request->post());
        return redirect()->route('transaction.index')->with('success', 'transaksi berhasil di perbaharui', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Cari transaksi yang akan dihapus
    $transaction = TransactionM::find($id);

    // Cek apakah transaksi ditemukan
    if (!$transaction) {
        return redirect()->route('transaction.index')->with('error', 'Transaksi tidak ditemukan');
    }

    // Ambil kursi terkait
    $kursi = kursiM::find($transaction->id_kursi);

    // Ubah status kursi menjadi 'free'
    $kursi->status = 'free';
    $kursi->save();

    // Hapus transaksi
    $transaction->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus');
    
    }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data transaksi'
        ]);
       
        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'studio.*', 'transaction.id AS id_trans')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->join('studio', 'studio.id', '=', 'transaction.id_studio')
        ->orderBy('transaction.id', 'desc')->get();

        $pdf = PDF::loadview('transaction/transaction_pdf', ['transaction' => $transaction]);
        return $pdf->stream('transaction.pdf', compact('log'));
    }

    public function filterPdf(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'studio.*', 'transaction.id AS id_trans')
            ->join('product', 'product.id', '=', 'transaction.id_produk')
            ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
            ->join('studio', 'studio.id', '=', 'transaction.id_studio')
            ->whereBetween('transaction.created_at', [$start_date, $end_date])
            ->orderBy('transaction.id', 'desc')
            ->get();
    
        $pdf = PDF::loadview('transaction/transaction_pdf', ['transaction' => $transaction]);
        return $pdf->stream('transaction.pdf');
    }
    

    public function pdf2($id){
        // Ambil data transaksi dan produk berdasarkan ID
        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'studio.*', 'transaction.id AS id_trans')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->join('studio', 'studio.id', '=', 'transaction.id_studio')
        ->where('transaction.id', $id)->first();
        
        if ($transaction) {
            // Jika data ditemukan, buat PDF
            $pdf = PDF::loadView('transaction/transaction_struk', ['transaction' => $transaction]);
            return $pdf->stream('transaction.struk' . $id . '.pdf');
        } else {
            // Jika data tidak ditemukan, Anda dapat mengembalikan respons yang sesuai, misalnya, halaman 404.
            return response('Data transaksi tidak ditemukan', 404);
        }
        
    }

    public function all()
        {
            $subtittle = "tanggal";
            return view('transaction/transaction_date', compact('subtittle'));

        }

        public function pertanggal(Request $request)
        {
            //Gunakan tanggal yang diterima sesuai kebutuhan
            $tgl_awal = $request->input('tgl_awal');
            $tgl_akhir = $request->input('tgl_akhir');
            // add["tanggal awal: ".$tgl_awal, "tgl_akhir: ".$tgl_akhir]);

            $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'studio.*', 'transaction.id AS id_trans', 'transaction.created_at AS tanggal')
            ->join('product', 'product.id', '=', 'transaction.id_produk')
            ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
            ->join('studio', 'studio.id', '=', 'transaction.id_studio')
            ->whereBetween('transaction.created_at', [$tgl_awal . ' 00:00:00', $tgl_akhir . ' 23:59:59']) // Sesuaikan format waktu
            ->get();
            
            $pdf = PDF::loadview('transaction/transaction_tgl', ['transaction' => $transaction]);
            return $pdf->stream('stgl.pdf');
    }
}
