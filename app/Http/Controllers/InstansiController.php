<?php

namespace App\Http\Controllers;

use App\Models\Instansi; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::all();
        return view('pages.masteradmin.instansi.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('instansi.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:instansi,nama|max:100',
            'kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:kuota_tersedia',
        ]);

        Instansi::create($request->all());

        // Session::flash('success', 'Mitra berhasil ditambahkan.');
        return redirect()->route('instansi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        return view('instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Instansi $instansi)
    {
        return view('instansi.edit', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'nama' => 'required|unique:instansi,nama,' . $instansi->id . '|max:255',
        ]);

        $instansi->update($request->all());

        // Session::flash('success', 'instansi berhasil diperbarui.');
        return redirect()->route('instansi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        // Session::flash('success', 'instansi berhasil dihapus.');
        return redirect()->route('instansi.index');
    }

    public function blacklistunblacklist(Request $request)
    {
        Instansi::where('id', $request->id)->update($request->except(['_token', '_method']));
        $ket = "";
        if ($request->get('is_active') == 0) {
            $ket = "Unblacklist";
        } else {
            $ket = "Blacklist";
        }
        return redirect()->back()->with('success', 'Instansi berhasil di' . $ket);
    }
}
