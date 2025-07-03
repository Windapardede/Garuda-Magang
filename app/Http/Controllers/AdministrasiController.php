<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Pastikan ini mengarah ke model yang benar
use Illuminate\Http\Request;

use DateTime;
use Mail;
use App\Models\Notifikasi;

class AdministrasiController extends Controller
{
    /**
     * Menampilkan daftar pendaftar administrasi dengan filter dan pencarian.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Pengajuan::query()
        ->whereHas('nama', function ($q) {
            $q->where('role', '=', 'user');
        });

        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status_administrasi', $request->input('status'));
        }


        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->whereHas('nama', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        $perPage        = request('show', 10);
        $administrasi   =  $query->orderBy('id', 'desc')->paginate($perPage)->appends(request()->query());
        $limit          = [10, 25, 50, 100];

        return view('pages.seleksi.administrasi.index', compact('administrasi', 'limit'));
    }

    /**
     * Menampilkan dokumen terkait pendaftar (opsional).
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\View\View
     */
    public function dokumen(Pengajuan $pengajuan)
    {
        // Logika untuk menampilkan dokumen, sesuaikan dengan kebutuhan Anda
        // Contoh: return view('pages.administrasi.dokumen', compact('pengajuan'));
        return "Tampilan dokumen untuk Pengajuan ID: " . $pengajuan->id; // Placeholder
    }

    /**
     * Memperbarui status pendaftar menjadi 'diterima'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function terima(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_administrasi = 'diterima';
            $administrasi->status              = 'belumDiproses';
            $administrasi->save();

            //simpan notif mentee
            $sipanNotif                 = array();
            $sipanNotif['user_id']      = $administrasi->nama->id;
            $sipanNotif['title']        = "Administrasi";
            $sipanNotif['subtitle']     = 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya';
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
                            ->subject('Administrasi');
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

    /**
     * Memperbarui status pendaftar menjadi 'ditolak'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tolak(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_administrasi          = 'ditolak';
            $administrasi->status                       = 'ditolak';
            $administrasi->catatan_tolak_administrasi   = $request->catatan_tolak_administrasi; // Pastikan ada field ini di model Pengajuan
            $administrasi->save();

            //simpan notif mentee
            $sipanNotif                 = array();
            $sipanNotif['user_id']      = $administrasi->nama->id;
            $sipanNotif['title']        = "Administrasi";
            $sipanNotif['subtitle']     = 'Maaf Administrasi Anda Ditolak.'.' Alasan Ditolak : '.$administrasi->catatan_tolak_administrasi;
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
                            ->subject('Administrasi');
                });
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            return response()->json(['success' => true, 'message' => 'Pendaftar berhasil ditolak.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Pendaftar tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }
}
