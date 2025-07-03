<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Posisi; // Asumsi model Mentor
use App\Models\User; // Asumsi model User untuk mentee
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengajuan;

class KelolaMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Dummy data for Mentors (reduced to 3 entries)
        // In a real application, this data would be fetched from a database,
        // for example: $mentors = Mentor::all();
        // $mentors = [
        //     (object)[ // Ubah array asosiatif menjadi objek untuk konsistensi
        //         'id' => 1,
        //         'nama' => 'Budi Santoso',
        //         'email' => 'budi.santoso@example.com',
        //         'posisi_mentor' => 'Frontend Developer',
        //         'total_mentee' => 3,
        //         'is_active' => '1', // '1' for active, '0' for inactive
        //         'status' => 'aktif' // 'aktif' or 'tidak aktif'
        //     ],
        //     (object)[
        //         'id' => 2,
        //         'nama' => 'Siti Aminah',
        //         'email' => 'siti.aminah@example.com',
        //         'posisi_mentor' => 'UI/UX Designer',
        //         'total_mentee' => 5,
        //         'is_active' => '0',
        //         'status' => 'tidak aktif'
        //     ],
        //     (object)[
        //         'id' => 3,
        //         'nama' => 'Joko Susilo',
        //         'email' => 'joko.susilo@example.com',
        //         'posisi_mentor' => 'Backend Developer',
        //         'total_mentee' => 2,
        //         'is_active' => '1',
        //         'status' => 'aktif'
        //     ],
        // ];

        // $mentors = Mentor::select('mentor.*','posisi.nama as nama_mentor')->join('posisi', 'posisi.id','=','mentor.posisi_id')->get();
        $mentors = Mentor::all();
        foreach ($mentors as $items) {
            $mentee                 =  User::where('mentor_id', $items->id)->where('users.role', 'user')->get();
            $items->total_mentee    = $mentee->count();
        }
        $posisi  = Posisi::all();

        // Pass the dummy data to the view
        return view('pages.kelolaakun.kelolamentor.index', compact('mentors', 'posisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Simulate storing a new mentor (no actual database interaction)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Assuming 'users' table for emails
            'password' => 'required|string|min:8',
            'posisi' => 'required|string|max:255',
        ]);

        // In a real application, you would save the data to the database:
        $mentorsimpan = Mentor::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'posisi_mentor' => $request->posisi,
            'is_active' => '1',
        ]);

        $idmentor = $mentorsimpan->id;

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mentor',
            'position' => $request->posisi,
            'mentor_id' => $idmentor
        ]);

        // dd($idmentor);

        // $mentors = Mentor::select('mentor.*','posisi.nama as nama_mentor')->join('posisi', 'posisi.id','=','mentor.posisi_id')->get();
        $mentors = Mentor::all();
        foreach ($mentors as $items) {
            $mentee                 =  User::where('mentor_id', $items->id)->where('users.role', 'user')->get();
            $items->total_mentee    = $mentee->count();
        }
        return $mentors;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Simulate updating mentor status (no actual database interaction)
        // This method is called when changing mentor status (aktif/nonaktif)
        $request->validate([
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // In a real application, you would find and update the mentor:
        $mentor = Mentor::findOrFail($id);
        $mentor->is_active = ($request->status === 'aktif' ? '1' : '0');
        $mentor->save();

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Simulate deleting a mentor (no actual database interaction)
        // In a real application, you would delete the mentor:
        Mentor::destroy($id);
        User::where('mentor_id', $id)->where('role', 'mentor')->delete();
        User::where('mentor_id', $id)->update(['mentor_id' => null]);

        return redirect()->route('kelolamentor.index')->with('success', 'Mentor berhasil dihapus!');
    }

    /**
     * Display the mentees for a specific mentor.
     * This method is part of the resource routes (GET /kelolamentor/{id}).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $Mentees            = User::where('mentor_id', $id)->where('users.role', 'user')->get();
        $currentMentor      = Mentor::select('mentor.*')->where('mentor.id', $id)->first();

        $availableMentees   = $this->magangAktif();

        return view('pages.kelolaakun.kelolamentor.show_mentee', compact('currentMentor', 'availableMentees', 'Mentees'));
    }

    public function magangAktif()
    {

        $tanggalSekarang    = date('Y-m-d');
        $query              = Pengajuan::where('status_administrasi', 'diterima')
            ->where('status_tes_kemampuan', 'diterima')
            ->where('status_wawancara', 'diterima')
            ->whereHas('nama', function ($q) use ($tanggalSekarang) {
                $q->whereDate('mulai_magang', '<=', $tanggalSekarang)
                    ->whereDate('selesai_magang', '>=', $tanggalSekarang)
                    ->whereNull('mentor_id');
            })->get();

        return $query;
    }

    /**
     * Attach a mentee to a mentor.
     * This method will be called when the form in the modal is submitted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $mentorId
     * @return \Illuminate\Http\Response
     */
    public function storeMentee(Request $request, $mentorId)
    {

        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $menteeId = $request->input('mentee_id');

        // Simulasi logika untuk "mengikat" mentee ke mentor:
        // Di aplikasi nyata, Anda akan mencari mentee berdasarkan $menteeId
        // dan memperbarui kolom mentor_id-nya di database.
        // Contoh:
        // $mentee = User::findOrFail($menteeId); // Asumsi mentee adalah User
        // $mentee->mentor_id = $mentorId;
        // $mentee->save();

        // Juga, di aplikasi nyata, Anda mungkin ingin memperbarui 'total_mentee' di model Mentor
        // $mentor = Mentor::findOrFail($mentorId);
        // $mentor->increment('total_mentee');

        // Untuk dummy data, kita hanya akan merespons sukses
        return response()->json(['message' => 'Mentee berhasil ditambahkan ke mentor ini!'], 200);
    }

    /**
     * Detach a mentee from a mentor.
     *
     * @param  int  $mentorId
     * @param  int  $menteeId
     * @return \Illuminate\Http\Response
     */
    public function destroyMentee($mentorId, $menteeId)
    {
        // Simulasi logika untuk "melepaskan" mentee dari mentor:
        // Di aplikasi nyata, Anda akan mencari mentee berdasarkan $menteeId
        // dan mengatur kolom mentor_id-nya menjadi null atau menghapusnya.
        // Contoh:
        // $mentee = User::where('id', $menteeId)->where('mentor_id', $mentorId)->firstOrFail();
        // $mentee->mentor_id = null; // Atau hapus mentee jika itu kasusnya
        // $mentee->save();

        // Juga, di aplikasi nyata, Anda mungkin ingin memperbarui 'total_mentee' di model Mentor
        // $mentor = Mentor::findOrFail($mentorId);
        // $mentor->decrement('total_mentee');

        // Untuk dummy data, kita hanya akan merespons sukses
        return response()->json(['message' => 'Mentee berhasil dihapus dari mentor ini!'], 200);
    }
}
