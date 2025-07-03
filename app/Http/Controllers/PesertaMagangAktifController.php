<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pengajuan;
use App\Models\Posisi;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\HomeController;
use Carbon\Carbon;

class PesertaMagangAktifController extends Controller
{

    public function index(){
        $magangaktif        = $this->magangAktif();
        $uniquePositions    = Posisi::all();
        $uniqueInstansi     = Instansi::all();
        $limit              = [10, 25, 50, 100];

        return view('pages.laporan.pesertamagangaktif.index', compact('magangaktif', 'uniquePositions', 'uniqueInstansi', 'limit'));
    }


    public function magangAktif()
    {
        $tanggalSekarang = date('Y-m-d');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            ->whereHas('user', function ($q) use ($tanggalSekarang) {
                $q->whereDate('mulai_magang', '<=', $tanggalSekarang)
                ->whereDate('selesai_magang', '>=', $tanggalSekarang);

                if (\Auth::check() && \Auth::user()->role === 'mentor') {
                    $q->where('mentor_id', \Auth::user()->mentor_id);
                }
            })
            ->whereHas('projects.detailProjects', function ($q) {
                $q->where(function ($sub) {
                    $sub->where('persentasi', '<', 100)
                        ->orWhere('status', '!=', 'diterima');
                });
            })
            ->whereDoesntHave('projects.detailProjects', function ($q) {
                $q->where('persentasi', 100)
                ->where('status', 'diterima');
            });

        // Filter berdasarkan posisi jika ada
        if ($position = request('position')) {
            $query->where('posisi_id', $position);
        }

        // Filter berdasarkan nama jika ada
        if ($search = request('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $perPage = request('show', 10);
        return $query->paginate($perPage)->appends(request()->query());
    }



    public function exportPdf(){
        $startDate  = request('start_date') ? Carbon::createFromFormat('d/m/Y', request('start_date'))->format('Y-m-d') : null;
        $endDate    = request('end_date') ? Carbon::createFromFormat('d/m/Y', request('end_date'))->format('Y-m-d') : null;
        $position   = request('position');
        $instansi   = request('instansi');
        $sortOrder  = request('sort_order', 'asc');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima');

        if ($startDate && $endDate) {
            $query->whereHas('nama', function ($q) use ($startDate, $endDate) {
                $q->whereDate('mulai_magang', '>=', $startDate)
                ->whereDate('selesai_magang', '<=', $endDate);
            });
        }

        if ($position) {
            $query->where('posisi_id', $position);
        }

        if ($instansi) {
            $query->whereHas('nama.instansi', function ($q) use ($instansi) {
                $q->where('id', $instansi);
            });
        }

        $magangaktif = $query->orderBy('created_at', $sortOrder)->get();

        // dd($magangaktif);

        $pdf = Pdf::loadView('pdf.pesertamagangaktif', compact('magangaktif'))->setPaper('A4', 'landscape');
        return $pdf->stream('peserta-magang-aktif.pdf');
    }
}
