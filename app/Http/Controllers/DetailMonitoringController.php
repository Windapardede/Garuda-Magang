<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\DetailProject;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DetailMonitoringController extends Controller
{

    public function show($id)
    {
        $project = Project::where('pengajuan_id', $id)->orderBy('jenis', 'asc')->get();
        foreach($project as $items){
            $cekDetail          = DetailProject::where('project_id', $items->id)->orderBy('id', 'DESC')->first();
            $items->persentase  = $cekDetail->persentasi ?? 0;

            if($items->persentase >= 100 && $cekDetail->status == 'diterima'){
                $items->status = 'diterima';
            }else{
                $items->status = 'proses';
            }
        }

        return view('pages.mentor.monitoring.detail1', compact('project'));
    }

}
