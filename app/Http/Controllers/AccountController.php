<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->accounts()->orderBy('name')->get();
        return view('accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'balance' => 'required|numeric|min:0',
        ]);

        auth()->user()->accounts()->create($validated);

        return back()->with('success', 'Sumber dana baru berhasil ditambahkan!');
    }

    public function destroy(Account $account)
    {
        if ($account->user_id !== auth()->id()) {
            abort(403);
        }

        // Opsional: Cek apakah akun masih punya transaksi
        if ($account->transactions()->exists()) {
            return back()->with('error', 'Akun tidak bisa dihapus karena sudah memiliki riwayat transaksi.');
        }

        $account->delete();
        return back()->with('success', 'Akun berhasil dihapus!');
    }
}
