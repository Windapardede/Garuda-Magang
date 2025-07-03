<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class MenteeController extends Controller
{
    /**
     * Store a newly created mentee for a specific mentor.
     * This method handles adding a mentee to a mentor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $mentorId // Laravel automatically injects the mentor ID from the nested route
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $mentorId)
    {
        // Validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required|integer|exists:users,id', // Pastikan mentee_user_id ada di tabel users
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        User::where('id', $request->mentee_id)->update(['mentor_id' => $mentorId]);



        // Untuk tujuan dummy, kita bisa mengembalikan pesan sukses
        return response()->json(['message' => 'Mentee berhasil ditambahkan ke mentor ID ' . $mentorId . '!'], 200);
    }

    /**
     * Remove the specified mentee from a specific mentor.
     * This method handles detaching a mentee from a mentor.
     *
     * @param  int  $mentorId // Laravel automatically injects the mentor ID
     * @param  int  $menteeId // Laravel automatically injects the mentee ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($mentorId, $menteeId)
    {
        // --- Simulasi penghapusan mentee dari mentor ---
        // Dalam aplikasi nyata, Anda akan melakukan hal berikut:
        // 1. Cari mentor: $mentor = Mentor::findOrFail($mentorId);
        // 2. Detach mentee dari mentor: $mentor->mentees()->detach($menteeId);
        //    Atau jika ada model Mentee yang terhubung langsung ke pivot:
        //    Mentee::where('mentor_id', $mentorId)->where('user_id', $menteeId)->delete();

        User::where('id', $menteeId)->update(['mentor_id' => null]);

        // Untuk tujuan dummy, kita bisa mengembalikan pesan sukses
        return response()->json(['message' => 'Mentee ID ' . $menteeId . ' berhasil dihapus dari mentor ID ' . $mentorId . '!'], 200);
    }
}
