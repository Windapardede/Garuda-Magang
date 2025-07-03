<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class ProfileHrdController extends Controller
{
    /**
     * Menampilkan halaman profil admin.
     * Menggantikan fungsi 'index' dari resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() // Mengganti nama method dari 'showProfile' ke 'index'
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman profil.');
        }

        // Sesuaikan nama view jika perlu, 'pages.profile.index'
        return view('pages.hrd.profile.index', compact('user'));
    }

    /**
     * Memperbarui informasi profil pengguna admin.
     * Menggantikan fungsi 'update' dari resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user // Parameter yang diterima dari resource route jika ada {profileadmin}
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) // Mengganti nama method dari 'updateProfile' ke 'update'
    {
        /** @var User $user */
        $user = Auth::user(); // Ambil user yang sedang login, bukan dari parameter route jika ini update profil sendiri

        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user->name = $request->input('name');
        $user->position = $request->input('position');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path && $user->profile_photo_path !== 'images/profile_placeholder.jpg') {
                if (Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'profile_photo_url' => $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('images/profile_placeholder.jpg')
        ]);
    }

    /**
     * Menampilkan halaman ganti kata sandi untuk admin.
     * Ini adalah method kustom, bukan bagian dari resource.
     *
     * @return \Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        return view('pages.hrd.profile.sandi.index');
    }

    /**
     * Memperbarui kata sandi pengguna admin.
     * Ini adalah method kustom, bukan bagian dari resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Kata sandi saat ini salah.'],
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Kata sandi berhasil diperbarui!']);
    }
}
