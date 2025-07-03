<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Periode; // Menggunakan model Periode
use App\Models\User; // Menggunakan model Instansi
use App\Models\Posisi;
use App\Models\Instansi;
use App\Models\Notifikasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Mail;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftarMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pendaftarmagang    = $this->pendaftar();
        $uniquePositions    = Posisi::all();
        $uniqueInstansi     = Instansi::all();
        $limit              = [10, 25, 50, 100];

        return view('pages.laporan.pendaftarmagang.index', compact('pendaftarmagang', 'uniquePositions', 'uniqueInstansi', 'limit'));
    }

    public function pendaftar(){
        $subQuery = Pengajuan::selectRaw('MAX(id) as id')
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })->groupBy('user_id');

        $query      = Pengajuan::whereIn('id', $subQuery);

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



    public function exportPdf()
    {
        $startDate  = request('start_date') ? Carbon::createFromFormat('d/m/Y', request('start_date'))->format('Y-m-d') : null;
        $endDate    = request('end_date') ? Carbon::createFromFormat('d/m/Y', request('end_date'))->format('Y-m-d') : null;
        $position   = request('position');
        $instansi   = request('instansi');
        $sortOrder  = request('sort_order', 'asc');

        $tanggalSekarang = date('Y-m-d');


        $subQuery = Pengajuan::selectRaw('MAX(id) as id')
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        })->groupBy('user_id');


        $query = Pengajuan::whereIn('id', $subQuery);


        if ($startDate && $endDate) {
            $query->whereHas('nama', function ($q) use ($startDate, $endDate) {
                $q->whereDate('mulai_magang', '=', $startDate)
                ->whereDate('selesai_magang', '=', $endDate);
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


        $magangaktif = $query->with(['nama.instansi'])
                            ->orderBy('created_at', $sortOrder)
                            ->get();

        $pdf = Pdf::loadView('pdf.pendaftarmagang', compact('magangaktif'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('pendaftaran-magang.pdf');
    }


    public function pengajuan(Request $request, $id){
        $simpan = array();
        $simpan['user_id']      = auth()->user()->id;
        $simpan['posisi_id']    = $id;

        $simpanPeriode          = Periode::create([
            'user_id'           => auth()->user()->id,
            'tanggal_pengajuan' => now(),
            'tanggal_selesai'   => now()->addDays(90),
            'is_active'         => true,
        ]);

        $simpan['periode_id'] = $simpanPeriode->id;

        Pengajuan::create($simpan);
        $update =  [
            'posisi_id' => $id
        ];

        User::where('id', auth()->user()->id)->update($update);

        foreach(User::whereIn('role', ['admin', 'hrd'])->get() as $item){
            $sipanNotif                 = array();
            $sipanNotif['user_id']      = $item->id;
            $sipanNotif['title']        = "Pendaftaran";
            $sipanNotif['subtitle']     = auth()->user()->name.' Baru saja melakukan pendaftaran';
            $sipanNotif['is_viewed']    = 0;

            Notifikasi::create($sipanNotif);

            $email = $item->email;

            try {
                Mail::send('email.pendafataran', [
                    'nama' => auth()->user()->name,
                    ], function ($message) use ($email) {
                    $message->to($email)
                            ->subject('OTP');
                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }


        return redirect('kegiatanku')->with('success', 'Magang Sedang Diajukan');
    }
}
