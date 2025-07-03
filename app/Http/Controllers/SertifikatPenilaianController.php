<?php

namespace App\Http\Controllers;

use App\Models\SertifikatPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SertifikatPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sertifikatpenilaian = SertifikatPenilaian::all(); // Atau bisa menggunakan pagination: Jurusan::paginate(10);
        return view('pages.template.penilaian.index', compact('sertifikatpenilaian'));
    }
}
