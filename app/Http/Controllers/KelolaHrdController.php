<?php

namespace App\Http\Controllers;

use App\Models\User; // Asumsi Anda menggunakan model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KelolaHrdController extends Controller
{
    /**
     * Display a listing of the HRD accounts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua user dengan role 'hrd'
        // Sesuaikan 'role' dengan kolom dan nilai yang Anda gunakan untuk mengidentifikasi akun HRD
        $hrdAccounts = User::where('role', 'hrd')->orderBy('created_at', 'desc')->get();

        // Mengirim data akun HRD ke view 'hrd.accounts.index' (sesuaikan path view Anda)
        return view('pages.kelolaakun.kelolahrd.index', compact('hrdAccounts'));
    }

    /**
     * Store a newly created HRD account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Assuming 'users' table for emails
            'password' => 'required|string|min:8',

        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'hrd',
        ]);

         return true;
    }

    public function update(Request $request, $id)
    {
        // Simulate updating mentor status (no actual database interaction)
        // This method is called when changing mentor status (aktif/nonaktif)
        $request->validate([
            'status' => 'required',
        ]);

        // dd($request->status);

        // In a real application, you would find and update the mentor:
        $user = User::findOrFail($id);
        $user->is_active = ($request->status == 'true' ? '0' : '1');
        $user->save();

        return true;
    }

    /**
     * Toggle the active status of an HRD account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Request $request, $id)
    {
        $hrdAccount = User::where('role', 'hrd')->find($id);

        if (!$hrdAccount) {
            return response()->json(['message' => 'Akun HRD tidak ditemukan.'], 404);
        }


        $hrdAccount->is_active = !$hrdAccount->is_active; // Toggle status
        $hrdAccount->save();

        $status = $hrdAccount->is_active ? 'aktif' : 'tidak aktif';
        return response()->json(['message' => "Akun HRD {$hrdAccount->name} berhasil di{$status}kan.", 'new_status' => $status], 200);
    }

    /**
     * Remove the specified HRD account from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $hrdAccount = User::where('role', 'hrd')->find($id);

        if (!$hrdAccount) {
            return redirect()->back()->with('error', 'Akun HRD tidak ditemukan.');
        }

        // Tidak boleh menghapus akun sendiri (opsional, tergantung kebutuhan)


        try {
            $hrdAccount->delete();
            return redirect()->route('hrd.accounts.index')->with('success', 'Akun HRD berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus akun HRD. Error: ' . $e->getMessage());
        }
    }
}
