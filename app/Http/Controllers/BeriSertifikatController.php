<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kegiatanku;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\TemplateSertifikat;
use App\Models\Sertifikat;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use App\Models\KriteriaPenilaian;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;


use App\Models\Penilaian;

class BeriSertifikatController extends Controller
{

    public function index()
    {

        $beri = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')
            ->join('mentor', 'users.mentor_id', '=', 'mentor.id')
            ->join('posisi', 'pengajuan.posisi_id', '=', 'posisi.id')
            ->join('penilaian', 'penilaian.pengajuan_id', '=', 'pengajuan.id')
            ->select('pengajuan.*', 'users.name as user_name', 'users.email', 'posisi.nama as nama_posisi', 'mentor.nama', 'posisi.nama as nama_posisi')
            ->where('users.mentor_id', Auth::user()->mentor_id)
            ->where('pengajuan.status', '!=', 'ditolak')
            ->orderBy('pengajuan.created_at', 'desc')
            ->groupBy('pengajuan.user_id')
            ->get();

        foreach ($beri as $item) {
            $cekBeri = Sertifikat::where('pengajuan_id', $item->id)->first();
            if (!empty($cekBeri->location)) {
                $item->beri = 'true';
            }
        }

        return view('pages.mentor.berisertifikat.index', compact('beri'));
    }

    public function store(Request $request)
    {
        $cekTemplate = TemplateSertifikat::all();
        if ($cekTemplate->count() > 0) {
            foreach ($cekTemplate as $item) {


                Sertifikat::where('pengajuan_id', $request->item_id)->delete();

                $pengajuan = Pengajuan::find($request->item_id);
                $userCheck = User::find($pengajuan->user_id);

                $templatePath = storage_path('app/public/' . $item->file);
                $template = new TemplateProcessor($templatePath);
                $template->setValue('name', $request->nama);
                $template->setValue('title', 'Terimakasih sudah magang');
                $template->setValue('start_date', date('d/m/Y', strtotime($userCheck->mulai_magang)));
                $template->setValue('end_date', date('d/m/Y', strtotime($userCheck->selesai_magang)));

                $filename = str_replace(' ', '_', $request->nama) . '_' . $request->item_id;
                $docxPath = storage_path("app/public/sertifikat/sertifikat_{$filename}.docx");
                $pdfPathSertifikat = storage_path("app/public/sertifikat/sertifikat_{$filename}.pdf");

                $template->saveAs($docxPath);

                $docxPath = storage_path("app/public/sertifikat/sertifikat_{$filename}.docx");
                $pdfPath = storage_path("app/public/sertifikat/sertifikat_{$filename}.pdf");

                $sofficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"';
                $command = $sofficePath . ' --headless --convert-to pdf --outdir "' . dirname($pdfPath) . '" "' . $docxPath . '"';
                exec($command, $output, $return_var);

                if ($return_var !== 0) {
                    dd("❌ Gagal convert", $command, $output, $return_var);
                }



                $personalComponents = Penilaian::where('pengajuan_id', $request->item_id)
                    ->select('evaluation_name as komponen', 'value')
                    ->where('evaluation_type', 'personal')->get();

                if ($personalComponents->count() > 0) {
                    foreach ($personalComponents as $kc) {
                        $kc->nilai = intval($kc->value);
                    }
                } else {
                    $personalComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)
                        ->select('evaluation_name as komponen')
                        ->where('evaluation_type', 'personal')->get();
                    foreach ($personalComponents as $pc) {
                        $pc->nilai = null;
                    }
                }

                $kompetensiComponents = Penilaian::where('pengajuan_id', $request->item_id)
                    ->select('evaluation_name as komponen', 'value')
                    ->where('evaluation_type', 'competence')->get();

                if ($kompetensiComponents->count() > 0) {
                    foreach ($kompetensiComponents as $kc) {
                        $kc->nilai = intval($kc->value);
                    }
                } else {
                    $kompetensiComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)
                        ->select('evaluation_name as komponen')
                        ->where('evaluation_type', 'competence')->get();
                    foreach ($kompetensiComponents as $kc) {
                        $kc->nilai = null;
                    }
                }


                $pdfNilaiPath   = storage_path("app/public/sertifikat/nilai_{$filename}.pdf");
                $pdfNilai       = Pdf::loadView('pdf.nilai', compact('personalComponents', 'kompetensiComponents', 'pengajuan'))->setPaper('A4', 'landscape');
                file_put_contents($pdfNilaiPath, $pdfNilai->output());


                $finalPdfPath = storage_path("app/public/sertifikat/final_{$filename}.pdf");

                $pdf = new Fpdi();
                foreach ([$pdfPathSertifikat, $pdfNilaiPath] as $file) {
                    $pageCount = $pdf->setSourceFile($file);
                    for ($page = 1; $page <= $pageCount; $page++) {
                        $templateId = $pdf->importPage($page);
                        $size = $pdf->getTemplateSize($templateId);
                        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                        $pdf->useTemplate($templateId);
                    }
                }

                $pdf->Output('F', $finalPdfPath);


                Sertifikat::create([
                    'pengajuan_id' => $request->item_id,
                    'location' => "sertifikat/final_{$filename}.pdf",
                ]);

                return true;
            }
        }
    }

    public function generateNilai($id)
    {

        $pengajuan = Pengajuan::where('pengajuan.id', $id)->first();

        $personalComponents = Penilaian::where('pengajuan_id', $id)
            ->select('evaluation_name as komponen', 'value')
            ->where('evaluation_type', 'personal')->get();
        if ($personalComponents->count() > 0) {
            foreach ($personalComponents as $kc) {
                $kc->nilai = intval($kc->value);
            }
        } else {
            $personalComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'personal')->get();
            foreach ($personalComponents as $pc) {
                $pc->nilai = null;
            }
        }

        $kompetensiComponents = Penilaian::where('pengajuan_id', $id)
            ->select('evaluation_name as komponen', 'value')
            ->where('evaluation_type', 'competence')->get();
        if ($kompetensiComponents->count() > 0) {
            foreach ($kompetensiComponents as $kc) {
                $kc->nilai = intval($kc->value);
            }
        } else {
            $kompetensiComponents = KriteriaPenilaian::where('posisi_id', $pengajuan->posisi_id)->select('evaluation_name as komponen')->where('evaluation_type', 'competence')->get();
            foreach ($kompetensiComponents as $kc) {
                $kc->nilai = null;
            }
        }

        $pdf = Pdf::loadView('pdf.nilai', compact('personalComponents', 'kompetensiComponents', 'pengajuan', 'id'))->setPaper('A4', 'landscape');
        return $pdf->stream('nilai.pdf');
    }
}
