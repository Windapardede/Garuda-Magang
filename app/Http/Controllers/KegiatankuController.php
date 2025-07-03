<?php

namespace App\Http\Controllers;

use App\Models\Kegiatanku;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Sertifikat;
use App\Models\Project;
use App\Models\Soal;
use App\Models\DetailProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Penilaian;
use App\Models\Testimoni;

use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Models\Notifikasi;

class KegiatankuController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $kegiatanAktif  = request('kegitanaktif');
        $instansi       = Kegiatanku::all();
        $projects       = Project::where('user_id', Auth::id())->orderBy('jenis')->get();
        foreach ($projects as $item) {

            $cekDetail          = DetailProject::where('project_id', $item->id)->orderBy('id', 'DESC')->first();
            $item->persentase  = $cekDetail->persentasi ?? 0;

            if ($item->persentase >= 100 && $cekDetail->status == 'diterima') {
                $item->status = 'diterima';
            } else {
                $item->status = 'proses';
            }
        }
        $pengajuan      = Pengajuan::where('user_id', Auth::id())->get();
        $status         = false;
        $pengajuanAktif = array();
        foreach ($pengajuan as $key => $value) {
            if ($value->status == 'diterima' && $value->status_wawancara == 'diterima' && $value->status_tes_kemampuan == 'diterima' && $value->status_administrasi == 'diterima') {
                $status = true;
                $pengajuanAktif = $value;
                break;
            }
        }
        $user               = auth::user();
        $statusOpen         = array();
        if ($kegiatanAktif == 'true') {
            $statusOpen['kegitan']       = "active";
            $statusOpen['kegitanselect'] = "show active";
        } else {
            $statusOpen['pendaftaran']       = "active";
            $statusOpen['pendaftaranselect'] = 'show active';
        }

        $ceknilai = Penilaian::where('pengajuan_id', @$pengajuanAktif->id)->get();
        $testimoni = false;
        if ($ceknilai->count() > 0) {
            $testimoni      = true;
        }

        $cekteti = Testimoni::where('user_id', Auth::id())->get();
        $sertifikat = false;
        if ($cekteti->count() > 0) {
            $sertifikat = true;
        }

        $ceksertifikat = Sertifikat::where('pengajuan_id', @$pengajuanAktif->id)->first();
        $berisertifikat = false;
        if (!empty($ceksertifikat->pengajuan_id)) {
            $berisertifikat = true;
        }

        return view('pages.user.have_acc.kegiatanku.index', compact('instansi', 'projects', 'pengajuan', 'status', 'pengajuanAktif', 'user', 'kegiatanAktif', 'statusOpen', 'testimoni', 'sertifikat', 'berisertifikat', 'ceksertifikat'));
    }

    public function store(Request $request)
    {

        $pengajuan      = Pengajuan::where('user_id', Auth::id())->get();
        $pengajuanid    = 0;
        foreach ($pengajuan as $key => $value) {
            if ($value->status == 'diterima' && $value->status_wawancara == 'diterima' && $value->status_tes_kemampuan == 'diterima' && $value->status_administrasi == 'diterima') {
                $pengajuanid = $value->id;
                break;
            }
        }
        // Simpan data ke database
        Project::create([
            'pengajuan_id'  => $pengajuanid,
            'title'         => $request->title,
            'jenis'         => $request->type,
            'user_id'       => Auth::id(),
        ]);



        return true;
    }


    public function update(Request $request, $id)
    {

        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->jenis = $request->type;
        $project->save();


        return true;
    }



    /**
     * Menampilkan halaman soal tes kemampuan untuk pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function soaluser()
    {
        // Variabel $soal akan dibuat di dalam Blade itu sendiri (untuk debugging atau data statis).
        // Jika Anda ingin mengambil data dari database di masa depan, uncomment dan sesuaikan baris di bawah:
        // use App\Models\Soal; // Tambahkan ini di bagian atas jika belum
        // $soal = Soal::latest()->first(); // Contoh: ambil soal terbaru dari database

        $kemampuan  = Pengajuan::where('user_id', Auth::id())->where('status_administrasi', 'diterima')->first();
        $soal       = Soal::where('id', @$kemampuan->soal_id)->first();

        // dd($kemampuan, $soal);

        return view('pages.user.have_acc.kegiatanku.soal', compact('soal', 'kemampuan'));
    }

    /**
     * Menangani proses unggah file jawaban PDF dari pengguna.
     * Menyimpan file ke storage dan mensimulasikan penyimpanan data ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadJawaban(Request $request)
    {

        if (!empty($request->file('file_jawaban'))) {
            $simpan         = array();
            $photo          = $request->file('file_jawaban');
            $extension      = $photo->getClientOriginalExtension();
            $fileName       = date('Ymdhis') . rand(11111, 99999) . '.' . $extension;
            $path           = $photo->storeAs('public/jawaban', 'jawaban-' . $fileName);
            $simpan['jawaban_tes_kemampuan']   = str_replace('public/', '', $path);
            Pengajuan::where('user_id', auth::user()->id)->where('status_administrasi', 'diterima')->update($simpan);
        }

        return redirect('kegiatanku')->with('success', 'Jawaban Anda berhasil diunggah!');
    }

    /**
     * Menampilkan detail proyek.
     *
     * @param  int  $id ID proyek
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showProjectDetail($id)
    {
        // Simulasi data proyek (ganti dengan pengambilan dari database)
        // Di masa depan, Anda akan mengambil data dari model Project, contoh:
        // $project = Project::findOrFail($id);

        $kegiatanAktif  = request('kegitanaktif');
        $instansi       = Kegiatanku::all();
        $projects       = Project::where('user_id', Auth::id())->get();
        foreach ($projects as $key => $value) {
            $value->persentase  = '50%';
            $value->status      = 'Proses';
        }
        $pengajuan      = Pengajuan::where('user_id', Auth::id())->get();
        $status         = false;
        $pengajuanAktif = array();
        foreach ($pengajuan as $key => $value) {
            if ($value->status == 'diterima' && $value->status_wawancara == 'diterima' && $value->status_tes_kemampuan == 'diterima' && $value->status_administrasi == 'diterima') {
                $status = true;
                $pengajuanAktif = $value;
                break;
            }
        }
        $user               = auth::user();
        $statusOpen         = array();
        if ($kegiatanAktif == 'true') {
            $statusOpen['kegitan']       = "active";
            $statusOpen['kegitanselect'] = "show active";
        } else {
            $statusOpen['pendaftaran']       = "active";
            $statusOpen['pendaftaranselect'] = 'show active';
        }

        if (!$projects) {
            return redirect()->route('kegiatanku.index')->with('error', 'Project not found.');
        }

        $detailProject = DetailProject::where('project_id', $id)->orderBy('id', 'desc')->get();
        return view('pages.user.have_acc.kegiatanku.detail', compact('projects', 'id', 'pengajuanAktif', 'user', 'detailProject'));
    }

    public function simpanDetailProject(Request $request, $id)
    {
        // dd($request->all());

        $detailProject              = new DetailProject();
        $detailProject->project_id  = $id;
        $detailProject->deskripsi   = $request->deskripsi;
        $detailProject->persentasi  = $request->persentase;

        $detailProject->save();

        //simpan notif mente
        $userMentor                 = User::where('mentor_id', Auth::user()->mentor_id)->where('role', 'mentor')->first();

        $sipanNotif                 = array();
        $sipanNotif['user_id']      = $userMentor->id;
        $sipanNotif['title']        = "Review Project";
        $sipanNotif['subtitle']     = Auth::user()->name . ' Telah Menambahkan progres project : ' . $request->deskripsi . ', Segera review untuk pekerjaan ini.';
        $sipanNotif['is_viewed']    = 0;

        Notifikasi::create($sipanNotif);

        $email = $userMentor->email;

        try {
            Mail::send('email.review-project', [
                'nama' => Auth::user()->name,
                'project' => $request->deskripsi,
                'halo' => 'Mentor',
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Review Project');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        return true;
    }

    public function editDetailProject(Request $request, $id)
    {
        // dd($request->all());

        $detailProject = DetailProject::findOrFail($request->id);
        $detailProject->deskripsi   = $request->deskripsi;
        $detailProject->persentasi  = $request->persentase;

        if (!empty($request->revisi)) {
            $detailProject->status   = 'proses';
        }

        $detailProject->save();

        return true;
    }

    public function testimoni(Request $request)
    {


        // Simpan testimoni ke database
        $user               = auth::user();
        Testimoni::create([
            'user_id'   => Auth::id(),
            'mentor_id' => $user->mentor_id,
            'content'   => $request->testimoni,
        ]);

        return true;
    }
}
