<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Soal;
use Illuminate\Http\Request;
use Carbon\Carbon;


use DateTime;
use Mail;
use App\Models\Notifikasi;

class KemampuanController extends Controller
{
    // Index
    public function index(Request $request)
    {

        $query = Pengajuan::where('status_tes_kemampuan', 'like', '%' . request('judul') . '%')->where('status_administrasi', 'diterima');
        $query->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        });

        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status_tes_kemampuan', $request->input('status'));
        }

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->whereHas('nama', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        $perPage        = request('show', 10);
        $kemampuan      =  $query->orderBy('id', 'desc')->paginate($perPage)->appends(request()->query());
        $limit          = [10, 25, 50, 100];



        foreach ($kemampuan as $key => $value) {
            $soal       = Soal::where('id', $value->soal_id)->first();
            if(!$soal){
                $value->soal = 'tidak';
            }else {
                $value->soal = 'ada';
            }
        }

        return view('pages.seleksi.kemampuan.index', compact('kemampuan', 'limit'));
    }

    // Create
    public function create()
    {
        $kemampuan = Pengajuan::all();
        return view('pages.seleksi.kemampuan.create_soal', compact('kemampuan'));
    }

    public function edit($id)
    {
        $kemampuan  = Pengajuan::findOrFail($id);
        $soal       = Soal::where('id', $kemampuan->soal_id)->first();
        return view('pages.seleksi.kemampuan.create_soal', compact('kemampuan', 'id', 'soal'));
    }

    public function terima(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_tes_kemampuan = 'diterima';
            $administrasi->status               = 'belumDiproses';
            $administrasi->save();


            //simpan notif mentee
            $sipanNotif                 = array();
            $sipanNotif['user_id']      = $administrasi->nama->id;
            $sipanNotif['title']        = "Tes Kemampuan";
            $sipanNotif['subtitle']     = 'Selamat Tes kemampuan Anda Telah diterima, Tunggu Proses Selanjutnya';
            $sipanNotif['is_viewed']    = 0;

            Notifikasi::create($sipanNotif);

            $email = $administrasi->nama->email;

            try {
                Mail::send('email.proses-seleksi', [
                    'nama' => '',
                    'project' => $sipanNotif['subtitle'],
                    'halo' => $administrasi->nama->name,
                    ], function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Tes Kemampuan');
                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            return response()->json(['success' => true, 'message' => 'Pendaftar berhasil diterima.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Pendaftar tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }

    public function tolak(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_tes_kemampuan = 'ditolak';
            $administrasi->status               = 'ditolak';
            $administrasi->catatan_tolak_tes_kemampuan = $request->catatan_tolak_tes_kemampuan; // Menyimpan catatan penolakan
            $administrasi->save();


            //simpan notif mentee
            $sipanNotif                 = array();
            $sipanNotif['user_id']      = $administrasi->nama->id;
            $sipanNotif['title']        = "Tes Kemampuan";
            $sipanNotif['subtitle']     = 'Maaf Tes Kemampuan Anda Ditolak.'.' Alasan Ditolak : '.$administrasi->catatan_tolak_tes_kemampuan;
            $sipanNotif['is_viewed']    = 0;

            Notifikasi::create($sipanNotif);

            $email = $administrasi->nama->email;

            try {
                Mail::send('email.proses-seleksi', [
                    'alasan' => '',
                    'project' => $sipanNotif['subtitle'],
                    'halo' => $administrasi->nama->name,
                    ], function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Tes Kemampuan');
                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            return response()->json(['success' => true, 'message' => 'Pendaftar berhasil diterima.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Pendaftar tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }

    // Store
    public function store(Request $request)
    {

        $pengajuan                              = Pengajuan::findOrFail($request->id);

        $pengajuan->tanggal_awal_tes_kemampuan  = $request->tanggal_awal_seleksi;
        $pengajuan->tanggal_akhir_tes_kemampuan = $request->tanggal_akhir_seleksi;

        Soal::where('id', $pengajuan->soal_id)->delete();
        $soal = Soal::create([
            'deskripsi' => $request->deskripsi,
            'soal' => $request->soal,
            'tanggal_mulai' => $request->tanggal_awal_seleksi,
            'tanggal_selesai' => $request->tanggal_akhir_seleksi,
        ]);

        $pengajuan->soal_id                     = $soal->id;

        $pengajuan->save();

        return redirect()->route('kemampuan.index')->with('success', 'Soal Barusaja Ditambahkan.');
    }

    // Show - Menampilkan detail soal kemampuan dengan data dummy
    public function show($id)
    {
        // Untuk tujuan dummy, kita gunakan data di bawah ini.
        // Dalam aplikasi nyata, Anda akan mengambil data dari database, contoh:
        // $soal = Pengajuan::findOrFail($id);

        $kemampuan  = Pengajuan::findOrFail($id);
        $soal       = Soal::where('id', $kemampuan->soal_id)->first();



        // Melewatkan objek $soal ke view
        return view('pages.seleksi.kemampuan.show_soal', compact('soal', 'id'));
    }
}
