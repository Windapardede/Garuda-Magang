<?php

namespace App\Http\Controllers;

use App\Models\Project;
// Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggalSekarang    = date('Y-m-d');
        $project            = Project::join('users', 'project.user_id', '=', 'users.id')
        ->select('project.*', 'users.name as user_name')
        ->where('users.mentor_id', auth()->user()->mentor_id)
        ->whereDate('mulai_magang', '<=', $tanggalSekarang)
        ->whereDate('selesai_magang', '>=', $tanggalSekarang)
        ->orderBy('project.created_at', 'desc')
        ->groupBy('project.user_id')
        ->get();
        foreach ($project as $item) {
            $cekDetail  = DetailProject::where('project_id', $item->id)->get();
            $jumlah     = $cekDetail->count();
            $diterima   = $cekDetail->where('status', 'diterima')->count();

            if ($jumlah > 0) {
                $item->persentase = round(($diterima / $jumlah) * 100, 1);
            } else {
                $item->persentase = 0;
            }
            if($item->persentase >= 100){
                $item->status = 'diterima';
            }else{
                $item->status = 'proses';
            }
        }
        return view('pages.mentor.monitoring.index', compact('project')); // Sesuaikan nama view jika perlu
    }


}
