<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jurusan;
use App\Models\Instansi;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileUserController extends Controller
{
    // Tampilkan halaman profil user
    public function index()
    {
        // $user = (object)[
        //     'name' => 'Winda Sari Pardede',
        //     'nim' => '203510494',
        //     'agama' => 'Islam',
        //     'email' => 'windasaripardede@gmail.com',
        //     'phone' => '085361047353',
        //     'gender' => 'Perempuan',
        //     'institution' => 'Politeknik Caltex Riau',
        //     'jurusan' => 'Teknik Informatika',
        //     'cv' => '1997142482424.pdf',
        //     'surat' => '1997142482424.pdf',
        //     'start_date' => '30/07/2023',
        //     'end_date' => '31/07/2023',
        //     'position' => 'Frontend Developer',
        // ];

        $user               = auth()->user();

        return view('pages.user.have_acc.profile.index', compact('user'));
    }
    // Tampilkan form create profile
    public function create()
    {
        return view('pages.user.have_acc.profile.create');
    }

    // Simpan data profil baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|max:10',
            'institution' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'surat' => 'nullable|file|mimes:pdf|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'position' => 'required|string|max:255',
        ]);



        // Simulasi penyimpanan (dummy)
        // Dalam implementasi asli, kamu bisa simpan ke database dan handle file upload

        return redirect()->route('profileuser.index')->with('success', 'Profil berhasil dibuat!');
    }


    // Tampilkan halaman edit profil
    public function edit($id)
    {
        // $user = (object)[
        //     'name' => 'Winda Sari Pardede',
        //     'nim' => '203510494',
        //     'agama' => 'Islam',
        //     'email' => 'windasaripardede@gmail.com',
        //     'phone' => '085361047353',
        //     'gender' => 'Perempuan',
        //     'institution' => 'Politeknik Caltex Riau',
        //     'jurusan' => 'Teknik Informatika',
        //     'cv' => '1997142482424.pdf',
        //     'surat' => '1997142482424.pdf',
        //     'start_date' => '30/07/2023',
        //     'end_date' => '31/07/2023',
        //     'position' => 'Frontend Developer',
        // ];

        $jurusanOptions     = Jurusan::all();
        $institusiOptions   = Instansi::all();
        $user               = auth()->user();

        return view('pages.user.have_acc.profile.edit', compact('user', 'jurusanOptions' ,'institusiOptions'));
    }

    // Simpan update profil
    public function update(Request $request, $id, User $user)
    {

        if (!empty($request->file('photo'))) {
            $simpan             = array();
            $photo              = $request->file('photo');
            $extension          = $photo->getClientOriginalExtension();
            $fileName           = date('Ymdhis').rand(11111,99999).'.'.$extension;
            $path               = $photo->storeAs('public/photo', $fileName);
            $simpan['image']    = str_replace('public/', '', $path);
            $user->where('id', auth()->user()->id)->update($simpan);
        }

        if (!empty($request->file('cv'))) {
            $simpan         = array();
            $photo          = $request->file('cv');
            $extension      = $photo->getClientOriginalExtension();
            $fileName       = date('Ymdhis').rand(11111,99999).'.'.$extension;
            $path           = $photo->storeAs('public/cv', 'cv-'.$fileName);
            $simpan['cv']   = str_replace('public/', '', $path);
            $user->where('id', auth()->user()->id)->update($simpan);
        }

        if (!empty($request->file('surat'))) {
            $simpan             = array();
            $photo              = $request->file('surat');
            $extension          = $photo->getClientOriginalExtension();
            $fileName           = date('Ymdhis').rand(11111,99999).'.'.$extension;
            $path               = $photo->storeAs('public/surat', 'surat-'.$fileName);
            $simpan['surat']    = str_replace('public/', '', $path);
            $user->where('id', auth()->user()->id)->update($simpan);
        }

        $user->where('id', auth()->user()->id)->update($request->except(['_token', '_method' ,'photo', 'cv', 'surat']));

        // Karena dummy, kita tidak simpan ke DB, cukup redirect dengan pesan sukses
        return redirect()->route('profileuser.index')->with('success', 'Profile berhasil diperbarui!');
    }

    public function changepassword(){

        return view('pages.user.have_acc.gantikatasandi');
    }

    public function updatepassword(Request $request){

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini salah.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('status', 'Kata sandi berhasil diperbarui.');

    }
}
