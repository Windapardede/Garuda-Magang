<?php

namespace App\Http\Controllers;

use App\Models\DetailProject;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class DetailProjekController extends Controller
{

    public function show($id)
    {
        $detailmonitoring = DetailProject::where('project_id', $id)->orderBy('id', 'desc')->get();
        return view('pages.mentor.monitoring.detail', compact('detailmonitoring'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $detailmonitoring = DetailProject::findOrFail($request->detail_id);
        if ($request->jenis == 'revisi') {
            $detailmonitoring->status = 'revisi';
            $detailmonitoring->revisi = $request->catatan_revisi;
        } else {
            $detailmonitoring->status = 'diterima';
            $detailmonitoring->revisi = null;

            if ($detailmonitoring->persentasi >= 100) {
                foreach (User::where('role', 'admin')->get() as $itemUser) {
                    $sipanNotif                 = array();
                    $sipanNotif['user_id']      = $itemUser->id;
                    $sipanNotif['title']        = "Project Selesai";
                    $sipanNotif['subtitle']     = $detailmonitoring->project->nama->name . ' Telah Menyelesaikan Project : ' . $detailmonitoring->deskripsi . ', Segera berikan nilai untuk pekerjaan ini.';
                    $sipanNotif['is_viewed']    = 0;

                    Notifikasi::create($sipanNotif);

                    $email = $itemUser->email;

                    try {
                        Mail::send('email.project-selesai', [
                            'nama' => $detailmonitoring->project->nama->name,
                            'project' => $detailmonitoring->deskripsi,
                            'halo' => 'Admin',
                        ], function ($message) use ($email) {
                            $message->to($email)
                                ->subject('Project Selesai');
                        });
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }

                //simpan notif mentor
                $sipanNotif                 = array();
                $sipanNotif['user_id'] = Auth::user()->id;
                $sipanNotif['title']        = "Project Selesai";
                $sipanNotif['subtitle']     = $detailmonitoring->project->nama->name . ' Telah Menyelesaikan Project : ' . $detailmonitoring->deskripsi . ', Segera berikan nilai untuk pekerjaan ini.';
                $sipanNotif['is_viewed']    = 0;

                Notifikasi::create($sipanNotif);

                $email = Auth::user()->email;

                try {
                    Mail::send('email.project-selesai', [
                        'nama' => $detailmonitoring->project->nama->name,
                        'project' => $detailmonitoring->deskripsi,
                        'halo' => 'Mentor',
                    ], function ($message) use ($email) {
                        $message->to($email)
                            ->subject('Project Selesai');
                    });
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
        }

        //simpan notif mentee
        $sipanNotif                 = array();
        $sipanNotif['user_id']      = $detailmonitoring->project->nama->id;
        $sipanNotif['title']        = "Review Mentor";
        $sipanNotif['subtitle']     = 'Mentor telah mereview project : ' . $detailmonitoring->deskripsi . ', Segera cek hasil review.';
        $sipanNotif['is_viewed']    = 0;

        Notifikasi::create($sipanNotif);

        $email = $detailmonitoring->project->nama->email;

        try {
            Mail::send('email.review-selesai', [
                'nama' => '',
                'project' => $detailmonitoring->deskripsi,
                'halo' => $detailmonitoring->project->nama->name,
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Review Mentor');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $detailmonitoring->save();

        return true;
    }
}
