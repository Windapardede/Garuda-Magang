<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posisi;
use App\Models\KriteriaPenilaian;

class KriteriaPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data dummy untuk Kriteria Penilaian
        // Dalam aplikasi nyata, data ini akan diambil dari database,
        // misalnya: $kriteria_penilaian = KriteriaPenilaian::all();

        $posisi = Posisi::all();
        foreach($posisi as $p){
            $p->total_kriteria = $p->kriteriaPenilaian->count();
        }
        // Mengirim data dummy ke view index.blade.php
        return view('pages.template.kriteriapenilaian.index', compact('posisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Posisi::findOrFail($id);;
        if (!$item) {
            return redirect()->route('kriteriapenilaian.index')->with('error', 'Kriteria Penilaian tidak ditemukan.');
        }

        $itemKriterial = KriteriaPenilaian::where('posisi_id', $id)->get();
        return view('pages.template.kriteriapenilaian.edit', compact('item', 'itemKriterial'));
    }

    // Anda bisa menambahkan method store, update, destroy di sini
    // untuk menangani operasi CRUD lainnya.

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // dd($id);
        if(empty($request->personal)){
            return redirect()->back()->with('error', 'Harap isi personal');
        }

        if(empty($request->kompetensi)){
            return redirect()->back()->with('error', 'Harap isi kompetensi');
        }

        KriteriaPenilaian::where('posisi_id', $id)->delete();

        foreach($request->personal as $personal){
            KriteriaPenilaian::create([
                'posisi_id'         => $id,
                'evaluation_name'   => $personal,
                'evaluation_type'   => 'personal',
            ]);
        }

        foreach($request->kompetensi as $kompetensi){
            KriteriaPenilaian::create([
                'posisi_id'         => $id,
                'evaluation_name'   => $kompetensi,
                'evaluation_type'   => 'competence',
            ]);
        }


        return redirect()->route('kriteriapenilaian.index')->with('success', 'Kriteria Penilaian berhasil ditambahkan!');
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
        // Logika untuk memperbarui data di database
        // Untuk data dummy, ini hanya simulasi
        $request->validate([
            'posisi_nama' => 'required|string|max:255',
            'total_kriteria' => 'required|integer|min:1',
            // Tambahkan validasi untuk detail kriteria jika ada
        ]);

        // Simulasi update data
        // $item = KriteriaPenilaian::find($id);
        // if ($item) {
        //     $item->update([
        //         'nama_posisi' => $request->posisi_nama,
        //         'total_kriteria' => $request->total_kriteria,
        //         // ...
        //     ]);
        // }

        return redirect()->route('kriteriapenilaian.index')->with('success', 'Kriteria Penilaian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Logika untuk menghapus data dari database
        // Untuk data dummy, ini hanya simulasi
        // KriteriaPenilaian::destroy($id);

        return redirect()->route('kriteriapenilaian.index')->with('success', 'Kriteria Penilaian berhasil dihapus!');
    }
}
