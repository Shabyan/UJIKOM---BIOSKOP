<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class productR extends Controller
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
            'activity' => 'User Melihat Halaman produk'
        ]);

        $subtittle = "halaman product";
        $product = productM::all();
        return view('product.product', compact('product', 'subtittle', 'log'));
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
            'activity' => 'User Melihat Halaman tambah produk'
        ]);

        $subtittle = "halaman tambah product";
        $product = productM::all();
        return view('product.product_create', compact('product', 'subtittle', 'log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jam_tayang' => 'required',
        ]);

        $product = new productM([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'jam_tayang' => $request->jam_tayang,
        ]);
        $product->save();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan produk'
        ]);

        return redirect()->route('product.index')->with('success', 'product Berhasil Ditambah', compact('log'));
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
            'activity' => 'User Melihat Halaman edit produk'
        ]);
        $subtittle = "halaman edit product";
        $product = productM::find($id);
        return view('product.product_edit', compact('product', 'subtittle', 'log'));
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
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Meng edit sebuah produk'
        ]);

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jam_tayang' => 'required',
        ]);

        $data = request()->except(['_token','_method','submit']);

        ProductM::where('id', $id)->update($data);
        return redirect()->route('product.index')->with('success', 'Data product Berhasil Diedit', compact('log'));
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
            'activity' => 'User Mengehapus sebuah produk'
        ]);
        productM::where('id',$id)->delete();
        return redirect()->route('product.index')->with('success', 'prduct Berhasil Dihapus', compact('log'));
    }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data Product'
        ]);
        $product = productM::all();
        $pdf = PDF::loadview('product/product_pdf', ['product' => $product]);
        return $pdf->stream('product.pdf', compact('log'));
    }
}
