<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;
class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $otp = rand(100000, 999999);
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'otp'      => $otp,
        ]);

        $date = date('d/m/Y');
        $time = date('H:i:s');

        try {
            Mail::send('layouts.email-otp', [
                'otp' => $otp,
                'date' => $date,
                'time' => $time,
            ], function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('OTP');
            });
        } catch (\Exception $e) {
            Log::error('Email gagal dikirim: ' . $e->getMessage());
            dd($e->getMessage()); // Tampilkan error langsung di browser
        }

        return response()->json(['message' => 'Registrasi berhasil!']);
    }
    public function verify(Request $request)
    {
        $email = $request->query('email');
        $otp = rand(100000, 999999);

        User::where('email', $email)->update(['otp' => $otp]);

        $date = date('d/m/Y');
        $time = date('H:i:s');

        try {
            Mail::send('layouts.email-otp', [
                'otp' => $otp,
                'date' => $date,
                'time' => $time,
            ], function ($message) use ($email) {
                $message->to($email)
                        ->subject('OTP');
            });
        } catch (\Exception $e) {
            Log::error('Email gagal dikirim: ' . $e->getMessage());
            dd($e->getMessage());
        }

        return redirect()->back();
    }

    public function verifikasi(Request $request)
    {
        $kode = "";
        foreach ($request->otp as $key => $value) {
            $kode .= $value;
        }
        $user = User::where('email', $request->email)
        ->where('otp', $kode)
        ->where('status_otp', 1)
        ->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Kode OTP salah atau sudah digunakan!');
        }else {
            User::where('email', $request->email)->where('otp', $kode)->update(['status_otp' => 2]);

            Auth::login($user);
            return redirect()->route('berhasildaftar.index')->with('success', 'Login berhasil!');
        }

    }
}
