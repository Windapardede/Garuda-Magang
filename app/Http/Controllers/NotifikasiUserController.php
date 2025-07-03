<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotifikasiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Notifikasi::all();
        return view('pages.user.have_acc.notifikasi.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }
}
