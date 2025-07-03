<?php

namespace App\Http\Controllers;

use App\Models\Testimoni; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimoni = Testimoni::all();
        return view('pages.testimoni.index', compact('testimoni')); // Sesuaikan nama view jika perlu
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimoni.create'); // Sesuaikan nama view jika perlu
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
            'name' => 'required|unique:testimoni,name|max:255',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean', // Jika ingin menerima input untuk status aktif
        ]);

        Testimoni::create($request->all());

        Session::flash('success', 'Testimoni berhasil ditambahkan.');
        return redirect()->route('testimoni.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimoni  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Testimoni $testimoni)
    {
        return view('testimoni.show', compact('testimoni')); // Sesuaikan nama view jika perlu
    }
}
