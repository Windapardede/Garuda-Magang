<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;
use DateTime;
use Mail;
use App\Models\Notifikasi;


class HomeController extends Controller
{

    public function index(Request $request)
    {

        $this->notifikasi();

        if(\Auth::user()->role == 'admin'){
            return $this->homeAdmin();
        }elseif(\Auth::user()->role == 'mentor'){
            return $this->homeMentor();
        }else{
            return $this->homeAdmin();
        }

    }

    public function homeAdmin(){
        $data                       = array();
        $data['magang_aktif']       = $this->magangAktif()->count();
        $data['total_pendaftar']    = $this->totalPendaftar()->count();
        $data['total_proses']       = $this->totalProses()->count();
        $data['total_alumni']       = $this->alumniMagang()->count();
        $data['grafik']             = $this->grafik();
        $type_menu                  = 'home';

        // dd($data);

        return view('pages.dashboard', compact('type_menu', 'data'));
    }

    public function grafik(){
        $bulan = array();
        for ($i=7; $i < 13; $i++) {
            if($i<10){
                $bulan[] = '0'.$i.'/'.date('Y');
            }else{
                $bulan[] = $i.'/'.date('Y');
            }
        }

        for ($i=1; $i < 7; $i++) {
            $bulan[] = '0'.$i.'/'.date('Y', strtotime('+0 year'));
        }

        $dataAktif = array();
        $dataPendaftar = array();
        foreach($bulan as $items){
            $dataAktif[]            = $this->jumlahMahangAktifBulan($items)->count();
            $dataPendaftar[]        = $this->jumlahPendaftarBulan($items)->count();
        }

        $respon                     = array();
        $respon['dataAktif']        = $dataAktif;
        $respon['dataPendaftar']    = $dataPendaftar;

        return $respon;

    }

    public function jumlahMahangAktifBulan($bulan){

        if($bulan == date('m/Y')){
            return $this->magangAktif();
        }else{
            $tanggalAwal = DateTime::createFromFormat('m/Y', $bulan)->modify('first day of this month')->format('Y-m-d');
            $tanggalAkhir = DateTime::createFromFormat('m/Y', $bulan)->modify('last day of this month')->format('Y-m-d');


            $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            // ->where(\DB::raw("date_format(created_at, '%m/%Y')"), $bulan)
            ->whereHas('nama', function ($q) use($tanggalAwal, $tanggalAkhir) {
                $q->whereDate('mulai_magang', '<=', $tanggalAwal)
                ->whereDate('selesai_magang', '>=', $tanggalAkhir);
                $q->where('role', '=', 'user');
            })->get();

            return $query;
        }


    }

    public function jumlahPendaftarBulan($bulan){
        $query = Pengajuan::select('user_id', \DB::raw('COUNT(*) as total'))
        ->where(\DB::raw("date_format(created_at, '%m/%Y')"), $bulan)
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })
        ->groupBy('user_id')
        ->get();

        return $query;
    }

    public function homeMentor(){
        $data                       = array();
        $data['magang_aktif']       = $this->magangAktif()->count();
        $data['total_alumni']       = $this->alumniMagang()->count();
        $data['total_monitoring']   = $this->monitoring()->count();
        return view('pages.mentor.dashboard', compact('data'));
    }

    public function magangAktif()
    {
        $tanggalSekarang = date('Y-m-d');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            ->whereHas('user', function ($q) use ($tanggalSekarang) {
                // $q->whereDate('mulai_magang', '<=', $tanggalSekarang)
                // ->whereDate('selesai_magang', '>=', $tanggalSekarang);

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

        return $query->get();
    }




    public function totalPendaftar(){
        $query = Pengajuan::select('user_id', \DB::raw('COUNT(*) as total'))
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })
        ->groupBy('user_id')
        ->get();
        return $query;
    }

    public function totalProses(){
        $query = Pengajuan::select('user_id', \DB::raw('COUNT(*) as total'))
        ->where('status', 'belumDiproses')
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })
        ->groupBy('user_id')
        ->get();
        return $query;
    }

    public function alumniMagang()
    {
        $tanggalSekarang = date('Y-m-d');

        $query = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            ->whereHas('user', function ($q) use ($tanggalSekarang) {
                $q->where('role', 'user');

                if (\Auth::user()->role == 'mentor') {
                    $q->where('mentor_id', \Auth::user()->mentor_id);
                }
            })
            ->whereHas('projects.detailProjects', function ($q) {
                $q->where('persentasi', 100)
                ->where('status', 'diterima');
            })
            ->get();

        return $query;
    }


    public function monitoring(){
        $tanggalSekarang    = date('Y-m-d');
        $project            = Project::join('users', 'project.user_id', '=', 'users.id')
        ->select('project.*', 'users.name as user_name')
        ->where('users.mentor_id', auth()->user()->mentor_id)
        ->whereDate('mulai_magang', '<=', $tanggalSekarang)
        ->whereDate('selesai_magang', '>=', $tanggalSekarang)
        ->orderBy('project.created_at', 'desc')
        ->groupBy('project.user_id')
        ->get();

        return $project;
    }

    public function notifikasi(){


        foreach(Pengajuan::where('status_administrasi', 'belumDiproses')->get() as $item){

            $tanggalAwal    = new DateTime(date('Y-m-d', strtotime($item->created_at)));
            $tanggalAkhir   = new DateTime(date('Y-m-d'));

            $selisih        = $tanggalAwal->diff($tanggalAkhir);
            $jumlahHari     = $selisih->days;

            if($jumlahHari >= 7){
                $where      = 'Kamu belum memproses pendaftaran '.$item->nama->name.' selama '.$jumlahHari.' Hari, segera lakukan proses pendaftaran';
                $cekNotif   = Notifikasi::where('subtitle', $where)->first();

                if(empty($cekNotif->user_id)){
                    foreach(User::whereIn('role', ['admin', 'hrd'])->get() as $itemUser){
                        if($itemUser->role == 'hrd'){
                            $where = str_replace("Kamu", 'Admin', $where);
                        }

                        $sipanNotif                 = array();
                        $sipanNotif['user_id']      = $itemUser->id;
                        $sipanNotif['title']        = "Proses Pendaftaran";
                        $sipanNotif['subtitle']     = $where;
                        $sipanNotif['is_viewed']    = 0;

                        Notifikasi::create($sipanNotif);

                        $email = $itemUser->email;

                        try {
                            Mail::send('email.proses-pendaftaran', [
                                'nama' => $item->nama->name,
                                'jumlahhari' => $jumlahHari,
                                'halo' => $item->role,
                                ], function ($message) use ($email) {
                                $message->to($email)
                                        ->subject('Proses Pendaftaran');
                            });
                        } catch (\Exception $e) {
                            dd($e->getMessage());
                        }
                    }
                }

            }
        }

        foreach(Pengajuan::where('status_wawancara', 'belumDiproses')->get() as $item){

            if($item->tanggal_wawancara > date('Y-m-d')){
                $tanggalAwal    = new DateTime(date('Y-m-d'));
                $tanggalAkhir   = new DateTime(date('Y-m-d', strtotime($item->tanggal_wawancara)));

                $selisih        = $tanggalAwal->diff($tanggalAkhir);
                $jumlahHari     = $selisih->days;
                if($jumlahHari == 1){

                    $where                      = 'Halo '.$item->nama->name.' kamu akan wawancara '.$jumlahHari.' Hari Lagi, pastikan melengkapi semua kebutuhan';

                    $cekNotif                   = Notifikasi::where('subtitle', $where)->first();

                    if(empty($cekNotif->user_id)){
                        $sipanNotif                 = array();
                        $sipanNotif['user_id']      = $item->user_id;
                        $sipanNotif['title']        = "Wawancara";
                        $sipanNotif['subtitle']     = $where;
                        $sipanNotif['is_viewed']    = 0;

                        Notifikasi::create($sipanNotif);

                        $email = $item->nama->email;

                        try {
                            Mail::send('email.proses-seleksi', [
                                'nama' => '',
                                'project' => 'kamu akan wawancara '.$jumlahHari.' Hari Lagi, pastikan melengkapi semua kebutuhan',
                                'halo' => $item->nama->name,
                                ], function ($message) use ($email) {
                                $message->to($email)
                                        ->subject('Wawancara');
                            });
                        } catch (\Exception $e) {
                            dd($e->getMessage());
                        }
                    }

                }
            }
        }
    }

}
