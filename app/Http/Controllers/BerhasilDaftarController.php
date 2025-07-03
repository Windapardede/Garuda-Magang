<?php

namespace App\Http\Controllers;

use App\Models\Instansi; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BerhasilDaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::all();
        return view('pages.user.have_acc.berhasildaftar.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }
}
