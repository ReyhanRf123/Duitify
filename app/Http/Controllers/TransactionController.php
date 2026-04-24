<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id'      => 'required|exists:accounts,id',
            'category_id'     => 'required|exists:categories,id',
            'saving_goal_id'  => 'nullable|exists:saving_goals,id', // Tambahkan ini
            'amount'          => 'required|numeric|min:1',
            'type'            => 'required|in:income,expense',
            'description'     => 'nullable|string',
            'date'            => 'required|date', // Tambahkan ini
            'attachment'      => 'nullable|image|max:2048', // Persiapan fitur foto
        ]);

        // Paksa masukkan user_id dari user yang sedang login
        $validated['user_id'] = Auth::id();

        return DB::transaction(function () use ($validated, $request) {
            // Handle upload file jika ada
            if ($request->hasFile('attachment')) {
                $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
            }

            // 1. Simpan Transaksi
            $transaction = Transaction::create($validated);

            // 2. Update Saldo Akun
            $account = Account::findOrFail($validated['account_id']);
            if ($validated['type'] === 'income') {
                $account->increment('balance', $validated['amount']);
            } else {
                $account->decrement('balance', $validated['amount']);
            }

            // 3. LOGIKA TAMBAHAN: Jika ini adalah alokasi tabungan (Saving Goal)
// Gunakan isset() untuk mengecek apakah kunci ada di array
            if (isset($validated['saving_goal_id']) && $validated['saving_goal_id']) {
                $goal = \App\Models\SavingGoal::findOrFail($validated['saving_goal_id']);
                $goal->increment('current_amount', $validated['amount']);
            }

            return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dicatat!');
        });
    }

    public function create()
    {
        $accounts = Auth::user()->accounts;
        $categories = Auth::user()->categories;
        $savingGoals = Auth::user()->savingGoals;

        return view('transactions.create', compact('accounts', 'categories', 'savingGoals'));
    }

    public function index(Request $request)
    {
        $query = Auth::user()->transactions()->with(['account', 'category']);

        // Logika Filter Sederhana (Opsional untuk dikembangkan nanti)
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Mengambil data dengan urutan terbaru dan dibatasi 10 per halaman
        $transactions = $query->latest('date')->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
}
