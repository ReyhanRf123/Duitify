<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index()
    {
        // Pastikan user punya kode, jika tidak lempar ke dashboard (atau login)
        if (!Auth::user()->two_factor_code) {
            return redirect()->route('dashboard');
        }
        return view('auth.verify-2fa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|integer',
        ]);

        $user = Auth::user();

        // Cek apakah kode cocok dan belum expired
        if ($request->two_factor_code == $user->two_factor_code && now()->lt($user->two_factor_expires_at)) {
            $user->resetTwoFactorCode();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['two_factor_code' => 'Kode salah atau sudah kedaluwarsa.']);
    }

    public function resend()
    {
        $user = Auth::user();
        $user->generateTwoFactorCode();
        $user->notify(new \App\Notifications\SendTwoFactorCode());

        return back()->with('success', 'Kode baru telah dikirim ke email kamu.');
    }
}