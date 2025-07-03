<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Posisi;
use Illuminate\Http\Request;

use DateTime;
use Mail;
use App\Models\Notifikasi;

class WawancaraController extends Controller
{
    // Index
    public function index(Request $request)
    {

        $query = Pengajuan::where('status_wawancara', 'like', '%' . request('judul') . '%')->where('status_tes_kemampuan', 'diterima');
        $query->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        });
        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status_wawancara', $request->input('status'));
        }


        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->whereHas('nama', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        $perPage        = request('show', 10);
        $wawancara      =  $query->orderBy('id', 'desc')->paginate($perPage)->appends(request()->query());
        $limit          = [10, 25, 50, 100];


        return view('pages.seleksi.wawancara.index', compact('wawancara', 'limit'));
    }

    // Create
    public function create(Request $request, $id)
    {
        // dd($request->all());
        $pengajuan                      = Pengajuan::findOrFail($id);

        $pengajuan->tanggal_wawancara   = $request->tanggal_wawancara;
        $pengajuan->jam_wawancara       = $request->jam_wawancara;
        $pengajuan->link_wawancara      = $request->link_wawancara;

        $pengajuan->save();
        return redirect()->route('wawancara.index')->with('success', 'Wawancara baru saja ditambahkan.');
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'posisi' => 'required',
            'asal_institusi' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|in:proses,lulus',
        ]);

        Pengajuan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil ditambahkan.');
    }

    // Edit
    public function edit(Pengajuan $wawancara)
    {
        $wawancara = Pengajuan::all();
        return view('pages.wawancara.edit', compact('wawancara', 'wawancara'));
    }

    // Update
    public function update(Request $request, Pengajuan $wawancara)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'posisi' => 'required',
            'asal_institusi' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|in:proses,lulus',
        ]);

        $wawancara->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil diperbarui.');
    }

    // Destroy
    public function destroy(Pengajuan $wawancara)
    {
        $wawancara->delete();
        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil dihapus.');
    }

    // Dokumen (opsional)
    public function dokumen(Pengajuan $wawancara)
    {
        return view('pages.wawancara.dokumen', compact('wawancara'));
    }

    public function terima(Request $request, $id)
    {

        $wawancara                              = Pengajuan::findOrFail($id);
        $wawancara->status_wawancara            = 'diterima';
        $wawancara->status                      = 'diterima';
        $wawancara->catatan_terima_wawancara    = $request->catatan_terima_wawancara;

        //simpan notif mentee
        $sipanNotif                 = array();
        $sipanNotif['user_id']      = $wawancara->nama->id;
        $sipanNotif['title']        = "Wawancara";
        $sipanNotif['subtitle']     = 'Selamat Wawancara Anda Telah diterima, Tunggu Proses Selanjutnya';
        $sipanNotif['is_viewed']    = 0;

        $userCheck = User::where('id', $wawancara->user_id)->first();

        Posisi::where('id', $wawancara->posisi_id)->decrement('kuota_tersedia');
        Instansi::where('id', $userCheck->instansi_id)->decrement('kuota_tersedia');

        Notifikasi::create($sipanNotif);

        $email = $wawancara->nama->email;

        try {
            Mail::send('email.proses-seleksi', [
                'nama' => '',
                'project' => $sipanNotif['subtitle'],
                'halo' => $wawancara->nama->name,
                ], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Wawancara');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $wawancara->save();

        return redirect()->route('wawancara.index')->with('success', 'Wawancara berhasil diterima.');
    }

    public function tolak(Request $request, $id)
    {
        // dd($id);

        $wawancara                          = Pengajuan::findOrFail($id);
        $wawancara->status_wawancara        = 'ditolak';
        $wawancara->status                  = 'ditolak';
        $wawancara->catatan_tolak_wawancara = $request->catatan_tolak_wawancara; // Menyimpan catatan penolakan

        //simpan notif mentee
        $sipanNotif                 = array();
        $sipanNotif['user_id']      = $wawancara->nama->id;
        $sipanNotif['title']        = "Wawancara";
        $sipanNotif['subtitle']     = 'Maaf Wawancara Anda Ditolak.'.' Alasan Ditolak : '.$wawancara->catatan_tolak_wawancara;
        $sipanNotif['is_viewed']    = 0;

        Notifikasi::create($sipanNotif);

        $email = $wawancara->nama->email;

        try {
            Mail::send('email.proses-seleksi', [
                'nama' => '',
                'project' => $sipanNotif['subtitle'],
                'halo' => $wawancara->nama->name,
                ], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Wawancara');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $wawancara->save();

        return true;
    }
}
