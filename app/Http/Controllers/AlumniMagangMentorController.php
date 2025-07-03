<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Periode;
use App\Models\Posisi;
use App\Models\Instansi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class AlumniMagangMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnimagang       = $this->alumniMagang();
        $uniquePositions    = Posisi::all();
        $uniqueInstansi     = Instansi::all();
        $limit              = [10, 25, 50, 100];


        return view('pages.mentor.alumni.index', compact('alumnimagang', 'uniquePositions', 'uniqueInstansi', 'limit'));
    }

    public function alumniMagang()
    {
        $tanggalSekarang = date('Y-m-d');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            ->whereHas('user', function ($q) use ($tanggalSekarang) {

                if (\Auth::check() && \Auth::user()->role === 'mentor') {
                    $q->where('mentor_id', \Auth::user()->mentor_id);
                }
            })
            ->whereHas('projects.detailProjects', function ($q) {
                $q->where('persentasi', 100)
                ->where('status', 'diterima');
            });


        if ($position = request('position')) {
            $query->where('posisi_id', $position);
        }


        if ($search = request('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }


        $perPage = request('show', 10);
        return $query->paginate($perPage)->appends(request()->query());
    }


    public function exportPdf()
    {
        $startDate  = request('start_date') ? Carbon::createFromFormat('d/m/Y', request('start_date'))->format('Y-m-d') : null;
        $endDate    = request('end_date') ? Carbon::createFromFormat('d/m/Y', request('end_date'))->format('Y-m-d') : null;
        $position   = request('position');
        $instansi   = request('instansi');
        $sortOrder  = request('sort_order', 'asc');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima');

        $query->whereHas('nama', function ($q) {
            $q->where('mentor_id', '=', \Auth::user()->mentor_id);
        });

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

        $alumnimagang = $query->orderBy('created_at', $sortOrder)->get();

        $pdf = Pdf::loadView('pdf.alumnimagang', compact('alumnimagang'))->setPaper('A4', 'landscape');
        return $pdf->stream('alumni-magang.pdf');
    }
}
