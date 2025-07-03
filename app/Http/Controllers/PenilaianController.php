<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilaian;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\KriteriaPenilaian;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $Mentees = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')
        ->join('mentor', 'users.mentor_id', '=', 'mentor.id')
        ->join('posisi', 'pengajuan.posisi_id', '=', 'posisi.id')
        ->select('pengajuan.*', 'users.name as user_name', 'users.email', 'mentor.nama','posisi.nama as nama_posisi')
        // ->where('users.mentor_id', auth()->user()->mentor_id)
        ->where('pengajuan.status', '!=', 'ditolak')
        ->orderBy('pengajuan.created_at', 'desc')
        ->get();

        // dd($Mentees);

        return view('pages.penilaian.index', compact('Mentees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->query('id');

        $pengajuan = Pengajuan::where('pengajuan.id', $id)->first();
        $personalComponents = Penilaian::where('pengajuan_id', $id)
        ->select('evaluation_name as komponen', 'value')
        ->where('evaluation_type', 'personal')->get();
        if($personalComponents->count() > 0){
            foreach($personalComponents as $kc){
                $kc->nilai = intval($kc->value);
            }
        }else{
            $personalComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'personal')->get();
            foreach($personalComponents as $pc){
                $pc->nilai = null;
            }
        }



        $kompetensiComponents = Penilaian::where('pengajuan_id', $id)
        ->select('evaluation_name as komponen', 'value')
        ->where('evaluation_type', 'competence')->get();

        if($kompetensiComponents->count() > 0){
            foreach($kompetensiComponents as $kc){
                $kc->nilai = intval($kc->value);
            }
        }else{
            $kompetensiComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'competence')->get();
            foreach($kompetensiComponents as $kc){
                $kc->nilai = null;
            }
        }
        $penilaianId = $id;
        return view('pages.penilaian.create', compact('penilaianId','personalComponents', 'kompetensiComponents', 'pengajuan', 'id')); // Tambahkan variabel yang dibutuhkan
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $id             = $request->query('id');
        $cekpengajuan   = pengajuan::where('pengajuan.id', $id)->join('users', 'pengajuan.user_id', '=', 'users.id')->first();
        Penilaian::where('pengajuan_id', $id)->delete();
        foreach($request->kompetensi_komponen as $key => $kompetensi){
            Penilaian::create([
                'pengajuan_id'      => $id,
                'mentor_id'         => $cekpengajuan->mentor_id,
                'evaluation_name'   => $kompetensi,
                'value'             => $request->kompetensi_nilai[$key],
                'evaluation_type'   => 'competence',
            ]);
        }

        foreach($request->personal_komponen as $key => $kompetensi){
            Penilaian::create([
                'pengajuan_id'      => $id,
                'mentor_id'         => $cekpengajuan->mentor_id,
                'evaluation_name'   => $kompetensi,
                'value'             => $request->personal_nilai[$key],
                'evaluation_type'   => 'personal',
            ]);
        }

        Session::flash('success', 'Penilaian berhasil ditambahkan!');
        return redirect()->route('penilaian.index');
    }

    public function show($id)
    {
       $pengajuan = Pengajuan::where('pengajuan.id', $id)->first();

        $personalComponents = Penilaian::where('pengajuan_id', $id)
        ->select('evaluation_name as komponen', 'value')
        ->where('evaluation_type', 'personal')->get();
        if($personalComponents->count() > 0){
            foreach($personalComponents as $kc){
                $kc->nilai = intval($kc->value);
            }
        }else{
            $personalComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'personal')->get();
            foreach($personalComponents as $pc){
                $pc->nilai = null;
            }
        }

        $kompetensiComponents = Penilaian::where('pengajuan_id', $id)
        ->select('evaluation_name as komponen', 'value')
        ->where('evaluation_type', 'competence')->get();
        if($kompetensiComponents->count() > 0){
            foreach($kompetensiComponents as $kc){
                $kc->nilai = intval($kc->value);
            }
        }else{
            $kompetensiComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'competence')->get();
            foreach($kompetensiComponents as $kc){
                $kc->nilai = null;
            }
        }

        return view('pages.penilaian.show', compact('personalComponents', 'kompetensiComponents', 'pengajuan', 'id'));
    }
}
