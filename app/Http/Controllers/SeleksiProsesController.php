<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Posisi;
use Illuminate\Support\Facades\Session;

class SeleksiProsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proses             = $this->seleksiProses();
        $uniquePositions    = Posisi::all();
        $uniqueInstansi     = Instansi::all();
        $limit              = [10, 25, 50, 100];

        return view('pages.seleksi.proses.index', compact('proses', 'uniquePositions', 'uniqueInstansi', 'limit'));
    }

    public function seleksiProses(){
        $subQuery = Pengajuan::selectRaw('MAX(id) as id')
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })
        ->groupBy('user_id');

        $query      = Pengajuan::whereIn('id', $subQuery)->where('status', 'belumDiproses');

        $position   = request('position');
        if ($position) {
            $query->where('posisi_id', $position);
        }

        $search = request('search');
        if ($search) {
            $query->whereHas('nama', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $perPage = request('show', 10);
        return $query->paginate($perPage)->appends(request()->query());
    }
}
